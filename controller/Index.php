<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\model\Student as StuModel;
class Index extends Controller
{
    
    public function create()
    {
        return view('create');
    }
    public function save(Request $request){
        $StuModel = new StuModel();
        $data = $request->param();
        $file = $request->file('student_pic');
        $info = $file->move('./static/upload');
        if(empty($info)){
            echo $file->getError();exit;
        }
        $data['student_pic'] = $info->getSaveName();
        $res = $StuModel->save($data);
        if($res){
            $this->success('添加成功',url('index'));
        }
    }
    public function index(Request $request){
        $StuModel = new StuModel();
        $studentInfo = $StuModel->select();
        return view('index',['studentInfo'=>$studentInfo]);
        
    }
}
?>