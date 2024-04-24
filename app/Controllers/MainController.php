<?php

namespace App\Controllers;

use App\Models\Products;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\Events\Events;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;
use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;
use Config\App;
use Dompdf\Dompdf;

class MainController extends BaseController
{
    public function __construct()
    {
        $this->products = new \App\Models\Products();
        $this->itemnary_group = new \App\Models\ProductItemnaryGroup();
        $this->itemnary = new \App\Models\ProductItemnary();
        $this->institutes = new \App\Models\Institutions();
        $this->orders = new \App\Models\Orders();
        $this->users = new UserModel();
    }
    public function index()
    {
        $postdata = $this->request->getPost();
        $inv_cookies = new Cookie('inventory');
        $products = $this->products->where('status', Products::STATUS_ACTIVE)->findAll();
        $products = array_reduce($products, function ($carry, $val) {
            $carry[$val['id']] = $val;
            return $carry;
        });
        $itemnary_group = $this->itemnary_group->Where('status', Products::STATUS_ACTIVE)->findAll();
        $itemnary = $this->itemnary->Where('status', Products::STATUS_ACTIVE)->findAll();
        $itemnary = array_reduce($itemnary, function ($carry, $val) {
            $carry[$val['item_group_id']][] = $val;
            return $carry;
        });
        $itemnary_group = array_reduce($itemnary_group, function ($carry, $val) use ($itemnary) {
            $val['items'] = $itemnary[$val['id']];
            $carry[$val['id']] = $val;
            return $carry;
        });

        foreach ($products as $prod_id => $prod_values) {
            foreach (json_decode($prod_values['itemnary']) as $items) {
                $products[$prod_id]['group'][$items] = $itemnary_group[$items];
            }
        }
        $data['products'] = $products;

        //Post request data is processed here
        if (!empty($postdata)) {
            $pages = 0;
            $files = [];
            $response = [];
            foreach ($this->request->getFiles()['print_file'] as $key => $img) {
                try {
                    $img = $this->request->getFile('print_file.' . $key);
                    if (in_array($img->guessExtension(), ['jpg', 'png', 'jpeg', 'webp'])) {
                        ++$pages;
                        if (!$img->hasMoved()) {
                            $filepath = 'uploads/' . $img->store();
                            array_push($files, $filepath);
                        }
                        $status = 1;
                    } elseif (in_array($img->guessExtension(), ['pdf'])) {
                        if (!$img->hasMoved()) {
                            $filepath = 'uploads/' . $img->store();
                            array_push($files, $filepath);
                        }
                        $parser = new \Smalot\PdfParser\Parser();
                        $pdf = $parser->parseFile(WRITEPATH . $filepath);
                        $pages += count($pdf->getPages());
                        $status = 1;
                    } else {
                        $status = 0;
                    }
                } catch (\Exception $e) {
                    $status = 0;
                }
            }
            $postdata['files'] = $files;
            $postdata['pages'] = $pages;
            $response['postdata'] = $postdata;
            $response['status'] = $status;
            return $this->response->setJSON($response);
        }

        return $this->render_page('home', $data);
    }
    public function cart()
    {
        $postdata = $this->request->getPost();
        if (isset($_COOKIE['inventory']) && !empty($_COOKIE['inventory'])) {
            $cart_data = json_decode(get_cookie('inventory'), true);
            $prod_ids = array_column($cart_data, 'product_id');
            $products = $this->products->where('status', Products::STATUS_ACTIVE)->whereIn('id', $prod_ids)->findAll();
            $products = array_reduce($products, function ($carry, $val) {
                $carry[$val['id']] = $val;
                return $carry;
            });
            $itemnary_group = $this->itemnary_group->Where('status', Products::STATUS_ACTIVE)->findAll();
            $itemnary = $this->itemnary->Where('status', Products::STATUS_ACTIVE)->findAll();
            $itemnary = array_reduce($itemnary, function ($carry, $val) {
                $carry[$val['item_group_id']][$val['id']] = $val;
                return $carry;
            });
            $itemnary_group = array_reduce($itemnary_group, function ($carry, $val) use ($itemnary) {
                $val['items'] = $itemnary[$val['id']];
                $carry[$val['id']] = $val;
                return $carry;
            });

            foreach ($products as $prod_id => $prod_values) {
                foreach (json_decode($prod_values['itemnary']) as $items) {
                    $products[$prod_id]['group'][$items] = $itemnary_group[$items];
                }
            }
            $data['products'] = $products;
            $data['cookies'] = $cart_data;
        } else {
            $data['products'] = [];
            $data['cookies'] = [];
        }
        $data['institutes'] = $this->institutes->findAll();
        //Post request data is processed here
        if (!empty($postdata)) {
            $pages = 0;
            $files = [];
            $response = [];
            foreach ($this->request->getFiles()['print_file'] as $key => $img) {
                try {
                    $img = $this->request->getFile('print_file.' . $key);
                    if ($img->getError() == 4) {
                        $files = json_decode(get_cookie('inventory'), true)[$postdata['index']]['files'];
                        $pages = json_decode(get_cookie('inventory'), true)[$postdata['index']]['pages'];
                        break;
                    }
                    if (in_array($img->guessExtension(), ['jpg', 'png', 'jpeg', 'webp'])) {
                        ++$pages;
                        if (!$img->hasMoved()) {
                            $filepath = 'uploads/' . $img->store();
                            array_push($files, $filepath);
                        }
                        $status = 1;
                    } elseif (in_array($img->guessExtension(), ['pdf'])) {
                        if (!$img->hasMoved()) {
                            $filepath = 'uploads/' . $img->store();
                            array_push($files, $filepath);
                        }
                        $parser = new \Smalot\PdfParser\Parser();
                        $pdf = $parser->parseFile(WRITEPATH . $filepath);
                        $pages += count($pdf->getPages());
                        $status = 1;
                    } else {
                        $status = 0;
                    }
                } catch (\Exception $e) {
                    $status = 0;
                }
            }
            if (!isset($status) && !empty($postdata)) {
                $status = 1;
            }
            $postdata['files'] = $files;
            $postdata['pages'] = $pages;
            $response['index'] = $postdata['index'];
            unset($postdata['index']);
            $response['postdata'] = $postdata;
            $response['status'] = $status;
            return $this->response->setJSON($response);
        }
        return view('includes/header.php') .
            view('cart.php', $data) .
            view('includes/footer.php');
    }
    public function profile()
    {
        return view('includes/header.php') .
            view('profile.php') .
            view('includes/footer.php');
    }

    public function login(): ResponseInterface
    {
        $postdata = $this->request->getPost();
        $data['postdata'] = $postdata;
        $users = auth()->getProvider()->findByCredentials(['email' => $postdata['mobile_number']]);
        $otp = 1111;
        if ($users) {
            $data['user_id'] = $users->id;
            $this->session->set('otp', $otp);
            $data['otp'] = $otp;
            $data['status'] = 1;
        } else {
            $all_users = auth()->getProvider();
            $last_id = $this->users->orderBy('id desc')->asArray()->findAll();
            print_r($last_id);die;
            if (count($last_id) == 0) {
                $last_id = 0;
            } else {
                $last_id = array_shift($last_id)[0];
            }
            $new_user = new User([
                'username' => 'USER_' . $last_id,
                'email'    => $postdata['mobile_number'],
            ]);

            if ($all_users->save($new_user)) {
                $data['user_id'] = $all_users->findById($all_users->getInsertID());
                $this->session->set('otp', $otp);
                $data['otp'] = $otp;
                $data['status'] = 2;
            } else {
                $data['status'] = 0;
            }
        }
        return $this->response->setJSON($data);
    }
    public function otp_verification(): ResponseInterface
    {
        $postdata = $this->request->getPost();
        if ($postdata['otp'] == $this->session->get('otp')) {
            $user = auth()->getProvider()->findByCredentials(['email' => $postdata['mobile_number']]);
            auth()->login($user);
            $data['valid'] = 1;
        } else {
            $data['valid'] = 0;
        }

        return $this->response->setJSON($data);
    }

    public function resend_otp(): ResponseInterface
    {
        $otp = 1111;
        $this->session->set('otp', $otp);
        $data['otp'] = $otp;
        $data['status'] = 1;
        return $this->response->setJSON($data);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/');
    }

    public function order_placed()
    {
        return $this->render_page('status/order_placed');
    }

    public function checkout()
    {
        $postdata = $this->request->getPost();
        $last_id = array_shift($this->orders->orderBy('id', SORT_DESC)->limit(1)->findAll());
        if (empty($last_id)) {
            $order_no = 'PRB' . now() . '0';
        } else {
            $order_no = 'PRB' . now() . $last_id['id'];
        }
        $order_arr = [
            'order_no' => $order_no,
            'status' => $this->orders::STATUS_ORDER_PLACED,
            'itemnary' => json_encode($postdata['itemnary']),
            'logs' => json_encode([now() => 'Order Placed']),
            'order_date' => date("Y-m-d H:i:s")
        ];
        if ($this->orders->save($order_arr)) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        return $this->response->setJSON($data);
    }
}
