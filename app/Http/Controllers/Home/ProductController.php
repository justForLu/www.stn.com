<?php
namespace App\Http\Controllers\Home;

use App\Enums\BannerPositionEnum;
use App\Enums\BasicEnum;
use App\Enums\CategoryTypeEnum;
use App\Http\Controllers\Admin\FileController;
use App\Models\Home\Banner;
use App\Models\Home\Category;
use App\Models\Home\Product;
use App\Repositories\Home\Criteria\ProductCriteria;
use App\Repositories\Home\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ProductController extends BaseController
{
    /**
     * @var ProductRepository
     */
    protected $product;

    public function __construct(ProductRepository $product)
    {
        parent::__construct();

        //案例展示的banner
        $banner = Banner::where('status','=',BasicEnum::ACTIVE)
            ->where('position','=',BannerPositionEnum::REVEAL1)
            ->orderBy('sort','ASC')
            ->first();
        if($banner){
            $banner->toArray();
            $banner_image = array_values(FileController::getFilePath($banner['image']));
            $banner['image_path'] = isset($banner_image[0]) ? $banner_image[0] : '';
        }else{
            $banner = array();
            $banner['image_path'] = '';
        }

        view()->share('banner', $banner);

        $this->product = $product;

    }

    /**
     * 自检手册分类
     * @param $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($type = 0)
    {
        //产品中心分类菜单
        $menu = array();
        $category = Category::where('type','=',CategoryTypeEnum::PRODUCT)
            ->where('status','=',BasicEnum::ACTIVE)
            ->orderBy('sort','ASC')
            ->get();
        if($type){
            foreach ($category as $key => $value){
                $menu[$key]['menu_url'] = url('/home/product/index', array($value['id']));
                $menu[$key]['title'] = $value['name'];
                $menu[$key]['is_active'] = ($value['id'] == $type) ? 'yes' : 'no';
            }
            $params['type'] = $type;
        }else{
            foreach ($category as $key => $value){
                $menu[$key]['menu_url'] = url('/home/product/index', array($value['id']));
                $menu[$key]['title'] = $value['name'];
                $menu[$key]['is_active'] = ($key == 0) ? 'yes' : 'no';
            }
            $params['type'] = isset($category[0]['id']) ? $category[0]['id'] : '0';
        }

        $this->product->pushCriteria(new ProductCriteria($params));

        $list = $this->product->paginate(Config::get('home.page_size',12));
        //处理图片
        foreach($list as $key => $value){
            $product_image = array_values(FileController::getFilePath($value->image));
            $list[$key]['image_path'] = isset($product_image[0]) ? $product_image[0] : '';
        }

        return view('home.product.index',compact('list','menu'));
    }

    /**
     * 自检手册分类详情
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail($id,Request $request){

        $product = $this->product->find($id);
        //产品中心分类菜单
        $menu = array();
        $category = Category::where('type','=',CategoryTypeEnum::PRODUCT)
            ->where('status','=',BasicEnum::ACTIVE)
            ->orderBy('sort','ASC')
            ->get();
        foreach ($category as $key => $value){
            $menu[$key]['menu_url'] = url('/home/product/index', array($value['id']));
            $menu[$key]['title'] = $value['name'];
            $menu[$key]['is_active'] = ($value['id'] == $product->type) ? 'yes' : 'no';
        }

        $product->pictures = FileController::getFilePath($product->picture);
        $product->content = htmlspecialchars_decode($product->content);

        $product_list = Product::where('id','<>',$product->id)
            ->where('status','=',BasicEnum::ACTIVE)
            ->limit(4)
            ->orderBy('sort','ASC')
            ->get();
        //处理图片
        foreach($product_list as $key => $value){
            $product_image = array_values(FileController::getFilePath($value->image));
            $product_list[$key]['image_path'] = isset($product_image[0]) ? $product_image[0] : '';
        }
        //产品阅读量加1
        Product::where('id','=',$id)->update(array('read' => ($product->read + 1)));

        return view('home.product.detail',compact('product','product_list','menu'));
    }

}




