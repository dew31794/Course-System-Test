<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Lecturer;
use App\Transformers\ListCourse\CourseTransformer as CourseListTransformer;
use App\Transformers\CreateCourse\CourseTransformer as CourseCreateTransformer;
use App\Transformers\SingleCourse\CourseTransformer as CourseSingleTransformer;
use App\Transformers\UpdateCourse\CourseTransformer as CourseUpdateTransformer;
use App\Http\Requests\API\CreateCourseRequest;
use App\Http\Requests\API\UpdateCourseRequest;
use OpenApi\Annotations as OA;

class CourseController extends ApiController
{
    /**
    * @OA\Get(
    *     path="/api/course/read",
    *     summary="取得課程列表",
    *     description="暫無描述。",
    *     tags={"Course"},
    *     @OA\Response(
    *          response=200,
    *          description="請求成功。",
    *          content={@OA\MediaType(
    *              mediaType="application\json",
    *              @OA\Schema(
    *                  example={
    *                     "Status": "Success",
    *                     "Data": {
    *                       {
    *                         "id": 1,
    *                         "num": "2301A001",
    *                         "name": "專題演講",
    *                         "credits": 3,
    *                         "limit_people": 60,
    *                         "classroom_and_time": "管理學院 資訊大樓201，週二 13:10",
    *                         "instructors": "李專題",
    *                         "limit_illustrate": "限資管系,資訊工程系",
    *                         "required_illustrate": "資訊相關學系必修",
    *                         "remark": "本課程有期中/期末發表"
    *                       },
    *                       {
    *                         "id": 2,
    *                         "num": "2301A002",
    *                         "name": "資料結構",
    *                         "credits": 3,
    *                         "limit_people": 45,
    *                         "classroom_and_time": "管理學院 資訊大樓202，週一 09:10",
    *                         "instructors": "李專題",
    *                         "limit_illustrate": "限資管系,資訊工程系",
    *                         "required_illustrate": "資訊相關學系必修",
    *                         "remark": "無"
    *                       }
    *                     },
    *                     "TimeStamp": "2023-09-07T03:15:53.188607+08:00 CST"
    *                 }
    *              )
    *          )}
    *     )
    * )
    */
    public function index()
    {
        try{
            $course = Course::query();

            $listCourse = fractal($course->get(), new CourseListTransformer)->toArray();

            return $this->respondSuccess($listCourse);
        }catch(Exception $e){
            $message = "發生未知的錯誤：".$e->getMessage();
            $status_code = 500;
            return $this->respondError($message,$status_code);
        }
    }
    
    /**
    * @OA\Post(
    *      path="/api/course/create",
    *      summary="建立新課程",
    *      description="暫無描述。",
    *      tags={"Course"},
    *      @OA\RequestBody(
    *          @OA\MediaType(
    *              mediaType="application/json",
    *              @OA\Schema(
    *                  @OA\Property(
    *                      property="num",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="name",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="credits",
    *                      type="integer"
    *                  ),
    *                  @OA\Property(
    *                      property="limit_people",
    *                      type="integer"
    *                  ),
    *                  @OA\Property(
    *                      property="classroom_and_time",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="instructors",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="limit_illustrate",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="required_illustrate",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="remark",
    *                      type="string"
    *                  ),
    *                  example={
    *                      "num": "2301A051",
    *                      "name": "資料結構",
    *                      "credits": 3,
    *                      "limit_people": 40,
    *                      "classroom_and_time": "管理學院 資訊大樓303，週一 13:10",
    *                      "instructors": "P0002",
    *                      "limit_illustrate": "限資管系",
    *                      "required_illustrate": "資訊管理系必修",
    *                      "remark": "無"
    *                  }
    *              )
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="請求成功。",
    *          content={@OA\MediaType(
    *              mediaType="application\json",
    *              @OA\Schema(
    *                  example={
    *                      "Status": "Success",
    *                      "Data": {
    *                               "id": 7,
    *                               "num": "2301A051",
    *                               "name": "資料結構",
    *                               "credits": 3,
    *                               "limit_people": 40,
    *                               "classroom_and_time": "管理學院 資訊大樓303，週一 13:10",
    *                               "instructors": "黃電子",
    *                               "limit_illustrate": "限資管系",
    *                               "required_illustrate": "資訊管理系必修",
    *                               "remark": "無"
    *                           },
    *                      "TimeStamp": "2023-09-07T03:34:32.580848+08:00 CST"
    *                   }
    *              )
    *          )}
    *      )
    * )
    */
    public function store(CreateCourseRequest $request)
    {
        $data = Course::where('num', $request->num)->get();

        if(!count($data)){
            $course = Course::create($request->except(['_token']));
            
            $createCourse = fractal(Course::where('id', $course->id)->firstOrFail(), new CourseCreateTransformer);

            return $this->respondSuccess($createCourse);
        }else{
            $message = '課程編號已存在，請重新輸入。';
            $code = 422;

            return $this->respondError($message , $code);
        }
    }

    /**
    * @OA\Get(
    *      path="/api/course/show/{id}",
    *      summary="取得課程單一資訊",
    *      description="暫無描述。",
    *      tags={"Course"},
    *      @OA\Parameter(
    *          name="id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer",
    *              example="3"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="請求成功。",
    *          content={@OA\MediaType(
    *              mediaType="application\json",
    *              @OA\Schema(
    *                  example={
    *                      "Status": "Success",
    *                      "Data": {
    *                               "id": 3,
    *                               "num": "2301B001",
    *                               "name": "電子學",
    *                               "credits": 3,
    *                               "limit_people": 40,
    *                               "classroom_and_time": "工程學院 電子系大樓201，週二 13:10",
    *                               "instructors": "黃電子",
    *                               "limit_illustrate": "限工程學院所有科系",
    *                               "required_illustrate": "電子系必修",
    *                               "remark": "本課程為18週課程"
    *                           },
    *                      "TimeStamp": "2023-09-07T03:39:26.390217+08:00 CST"
    *                   }
    *              )
    *          )}
    *      )
    * )
    */
    public function show($id)
    {
        $course = Course::find($id);

        if(!empty($course)){
            $showCourse = fractal($course, new CourseSingleTransformer);

            return $this->respondSuccess($showCourse);
        }else{
            $message = '無任何資料，請重新確認';
            $code = 200;

            return $this->respondOther($message , $code);
        }
    }

    /**
    * @OA\Put(
    *      path="/api/course/update/{id}",
    *      summary="更新課程內容",
    *      description="暫無描述。",
    *      tags={"Course"},
    *      @OA\Parameter(
    *          name="id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer",
    *              example="4"
    *          )
    *      ),
    *      @OA\RequestBody(
    *          @OA\MediaType(
    *              mediaType="application/json",
    *              @OA\Schema(
    *                  @OA\Property(
    *                      property="name",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="credits",
    *                      type="integer"
    *                  ),
    *                  @OA\Property(
    *                      property="limit_people",
    *                      type="integer"
    *                  ),
    *                  @OA\Property(
    *                      property="classroom_and_time",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="instructors",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="limit_illustrate",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="required_illustrate",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="remark",
    *                      type="string"
    *                  ),
    *                  example={
    *                      "name" : "數位多媒體設計",
    *                      "credits" : 3,
    *                      "limit_people" : 60,
    *                      "classroom_and_time" : "創意媒體學院1館701，週四 13:10",
    *                      "instructors" : "P0003",
    *                      "limit_illustrate" : "限多媒體學院",
    *                      "required_illustrate" : "資訊傳播系必修",
    *                      "remark" : "本課程需做成果展示"
    *                  }
    *              )
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="請求成功。",
    *          content={@OA\MediaType(
    *              mediaType="application\json",
    *              @OA\Schema(
    *                  example={
    *                      "Status": "Success",
    *                      "Data": {
    *                               "id": 4,
    *                               "num": "2301C002",
    *                               "name": "數位多媒體設計",
    *                               "credits": 3,
    *                               "limit_people": 60,
    *                               "classroom_and_time": "創意媒體學院1館701，週四 13:10",
    *                               "instructors": "陳媒體",
    *                               "limit_illustrate": "限多媒體學院",
    *                               "required_illustrate": "資訊傳播系必修",
    *                               "remark": "本課程需做成果展示"
    *                           },
    *                      "TimeStamp": "2023-09-07T03:43:25.323960+08:00 CST"
    *                   }
    *              )
    *          )}
    *      )
    * )
    */

    public function update(UpdateCourseRequest $request , $id)
    {
        $course = Course::find($id);

        if(!empty($course)){
            $data = array(
                'name' => $request->name,
                'credits' => $request->credits,
                'limit_people' => $request->limit_people,
                'classroom_and_time' => $request->classroom_and_time,
                'instructors' => $request->instructors,
                'limit_illustrate' => $request->limit_illustrate,
                'required_illustrate' => $request->required_illustrate,
                'remark' => $request->remark,
            );

            if($course->update($data)){
                $updateCourse = fractal(Course::find($id), new CourseUpdateTransformer);

                return $this->respondSuccess($updateCourse);
            }else{
                $message = '更新失敗，請重新確認';
                $code = 422;
    
                return $this->respondError($message , $code);
            }
        }else{
            $message = '無任何資料，請重新確認';
            $code = 200;

            return $this->respondOther($message , $code);
        }
    }

    /**
    * @OA\Delete(
    *      path="/api/course/delete/{id}",
    *      summary="刪除課程",
    *      description="暫無描述。",
    *      tags={"Course"},
    *      @OA\Parameter(
    *          name="id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer",
    *              example="6"
    *          )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="請求成功。",
    *          content={@OA\MediaType(
    *              mediaType="application\json",
    *              @OA\Schema(
    *                  example={
    *                      "Status": "Success",
    *                      "Data": "體育課程已刪除。",
    *                      "TimeStamp": "2023-09-07T03:44:56.903975+08:00 CST"
    *                   }
    *              )
    *          )}
    *      )
    * )
    */
    public function destroy($id)
    {
        $course = Course::find($id);

        if(!empty($course)){
            if($course->delete()){
                $message = $course->name.'課程已刪除。';
                $code = 200;

                return $this->respondSuccessMsg($message , $code);
            }else{
                $message = '刪除失敗，請重新確認';
                $code = 422;
    
                return $this->respondError($message , $code);
            }
        }else{
            $message = '無任何資料被刪除，請重新確認';
            $code = 200;

            return $this->respondOther($message , $code);
        }
    }
}
