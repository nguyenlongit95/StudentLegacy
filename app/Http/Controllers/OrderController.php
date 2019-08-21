<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Orders\OrdersRepositoryInterface;
use App\Repositories\Products\ProductRepositoryInterface;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Repositories\OrdersDetails\OrderDetilasRepositoryInterface;
class OrderController extends Controller
{
    /**
     * Tại đây ta xây dựng CURL của controller cho Orders
     * Xây dựng cả CỦRL cho các OrderDetails
     * */
    protected $OrderRepository;
    protected $ProductRepository;
    protected $UsersRepository;
    protected $OrderDetailsRepository;

    public function __construct(
        OrdersRepositoryInterface $ordersReporitory,
        ProductRepositoryInterface $productReporitory,
        UsersRepositoryInterface $usersReporitory,
        OrderDetilasRepositoryInterface $orderDetilasReporitory
    )
    {
        $this->OrderRepository = $ordersReporitory;
        $this->ProductRepository = $productReporitory;
        $this->UsersRepository = $usersReporitory;
        $this->OrderDetailsRepository = $orderDetilasReporitory;
    }

    public function index(){
        $Orders = $this->OrderRepository->getAll(30);
        return view("admin.Orders.index",['Orders'=>$Orders]);
    }


    public function show($id){
        $Orders = $this->OrderRepository->find($id);
        return $Orders;
    }

    public function getStore(){
        $User = $this->UsersRepository->getAll(10000);
        return view('admin.Orders.create',['User'=>$User]);
    }

    public function store(Request $request){
        $data = $request->all();
        $Orders = $this->OrderRepository->create($data);
        if($Orders == true){
            return redirect('admin/Blog/Blogs')->with('thong_bao','Add new item success');
        }else{
            return redirect()->back()->with('thong_bao','Add new item failed');
        }
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $Orders = $this->OrderRepository->update($data,$id);
        if($Orders == true){
            return redirect()->back()->with('thong_bao','Update an item success!');
        }else{
            return redirect()->back()->with('thong_bao','Update an item failed!');
        }
    }

    /**
     * Các phương thức mở rộng của Order
     * Các phương thức get dữ liệu ra view
     * */
    public function getUpdateOrder($id){
        $Order = $this->show($id);
        $User = $this->UsersRepository->getAll(10000);
        $OrderDetails = $this->OrderDetailsRepository->getProduct($id);
        return view("admin.Orders.update",["Order"=>$Order,"User"=>$User,"OrderDetails"=>$OrderDetails]);
    }

    /**
     * Phương thức thêm cho các chi tiết của đơn hàng
     * Chỉ được phép sửa số lượng sản phẩm
     * Chỉ được phép xóa item
     * */
    public function postUpdateOrderDetails(Request $request,$id){
        $this->validate($request,[
            'Quantity'=>'required'
        ],[
            'Quantity.required'=>'Please enter number of product'
        ]);
        $Quantity = $request->Quantity;
        $UpdateOrderDetails = $this->OrderDetailsRepository->updateQuantity($id, $Quantity);
        if($UpdateOrderDetails == 1){
            return redirect()->back()->with('thong_bao','Update quantity success');
        }else{
            return redirect()->back()->with('thong_bao','Update quantity failed');
        }
    }
    public function deleteOrderDetails($id){
        $deleteOrderDetails = $this->OrderDetailsRepository->delete($id);
        if($deleteOrderDetails == true){
            return redirect()->back()->with('thong_bao','Delete item success');
        }else{
            return redirect()->back()->with('thong_bao','Delete item failed');
        }
    }
}
