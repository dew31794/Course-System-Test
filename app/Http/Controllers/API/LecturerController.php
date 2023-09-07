<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Lecturer;
use App\Transformers\ListLecturer\LecturerTransformer as LecturerListTransformer;
use App\Transformers\CreateLecturer\LecturerTransformer as LecturerCreateTransformer;
use App\Transformers\SingleLecturer\LecturerTransformer as LecturerSingleTransformer;
use App\Transformers\UpdateLecturer\LecturerTransformer as LecturerUpdateTransformer;
use App\Transformers\ListLecturerRelationCourse\LecturerTransformer as LecturerListAndCourseTransformer;
use App\Http\Requests\API\CreateLecturerRequest;
use App\Http\Requests\API\UpdateLecturerRequest;

class LecturerController extends ApiController
{
    /**
    * @OA\Get(
    *     path="/api/lecturer/read",
    *     summary="取得講師列表",
    *     description="暫無描述。",
    *     tags={"Lecturer"},
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
    *                         "num": "P0001",
    *                         "name": "李專題",
    *                         "department": "資訊管理系",
    *                         "fulltime": "專任",
    *                         "rank": "助理教授",
    *                         "specialty": "XXXXXXX",
    *                         "remark": "無"
    *                       },
    *                       {
    *                         "id": 2,
    *                         "num": "P0002",
    *                         "name": "黃電子",
    *                         "department": "電子工程系",
    *                         "fulltime": "專任",
    *                         "rank": "教授",
    *                         "specialty": "XXXXXXX",
    *                         "remark": "無"
    *                       },
    *                       {
    *                         "id": 3,
    *                         "num": "P0003",
    *                         "name": "陳媒體",
    *                         "department": "資訊傳播系",
    *                         "fulltime": "專任",
    *                         "rank": "副教授",
    *                         "specialty": "XXXXXXX",
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
    public function index(Request $request)
    {
        try{
            $lecturer = Lecturer::query();

            $listLecturer = fractal($lecturer->get(), new LecturerListTransformer)->toArray();

            return $this->respondSuccess($listLecturer);
        }catch(Exception $e){
            $message = "發生未知的錯誤：".$e->getMessage();
            $status_code = 500;
            return $this->respondError($message,$status_code);
        }
    }

    /**
    * @OA\Post(
    *      path="/api/lecturer/create",
    *      summary="建立新講師",
    *      description="暫無描述。",
    *      tags={"Lecturer"},
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
    *                      property="department",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="fulltime",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="rank",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="specialty",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="remark",
    *                      type="string"
    *                  ),
    *                  example={
    *                      "num": "P0006",
    *                      "name": "郭台鳴",
    *                      "department": "電子工程系",
    *                      "fulltime": "專任",
    *                      "rank": "教授",
    *                      "specialty": "最會賺錢的。",
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
    *                               "id": 6,
    *                               "num": "P0006",
    *                               "name": "郭台鳴",
    *                               "department": "電子工程系",
    *                               "fulltime": "專任",
    *                               "rank": "教授",
    *                               "specialty": "最會賺錢的。",
    *                               "remark": "無"
    *                           },
    *                      "TimeStamp": "2023-09-07T03:34:32.580848+08:00 CST"
    *                   }
    *              )
    *          )}
    *      )
    * )
    */
    public function store(CreateLecturerRequest $request)
    {
        $data = Lecturer::where('num', $request->num)->get();

        if(!count($data)){
            $lecturer = Lecturer::create($request->except(['_token']));
            
            $createLecturer = fractal($lecturer, new LecturerCreateTransformer);

            return $this->respondSuccess($createLecturer);
        }else{
            $message = '課程編號已存在，請重新輸入。';
            $code = 422;

            return $this->respondError($message , $code);
        }
    }

    /**
    * @OA\Get(
    *      path="/api/lecturer/show/{id}",
    *      summary="取得講師詳細資訊",
    *      description="暫無描述。",
    *      tags={"Lecturer"},
    *      @OA\Parameter(
    *          name="id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer",
    *              example="4"
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
    *                               "num": "P0004",
    *                               "name": "陳小二",
    *                               "department": "餐飲管理系",
    *                               "fulltime": "兼任",
    *                               "rank": "講師",
    *                               "specialty": "XXXXXXX",
    *                               "remark": "無"
    *                           },
    *                      "TimeStamp": "2023-09-07T03:53:18.837648+08:00 CST"
    *                   }
    *              )
    *          )}
    *      )
    * )
    */
    public function show($id)
    {
        $lecturer = Lecturer::find($id);

        if(!empty($lecturer)){
            $showLecturer = fractal($lecturer, new LecturerSingleTransformer);

            return $this->respondSuccess($showLecturer);
        }else{
            $message = '無任何資料，請重新確認';
            $code = 200;

            return $this->respondOther($message , $code);
        }
    }

    /**
    * @OA\Put(
    *      path="/api/lecturer/update/{id}",
    *      summary="更新講師資訊",
    *      description="暫無描述。",
    *      tags={"Lecturer"},
    *      @OA\Parameter(
    *          name="id",
    *          required=true,
    *          in="path",
    *          @OA\Schema(
    *              type="integer",
    *              example="5"
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
    *                      property="department",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="fulltime",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="rank",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="specialty",
    *                      type="string"
    *                  ),
    *                  @OA\Property(
    *                      property="remark",
    *                      type="string"
    *                  ),
    *                  example={
    *                      "name": "黃體操",
    *                      "department": "運動休閒系",
    *                      "fulltime": "兼任",
    *                      "rank": "講師",
    *                      "specialty": "體操、籃球、排球",
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
    *                               "id": 5,
    *                               "num": "P0005",
    *                               "name": "黃體操",
    *                               "department": "運動休閒系",
    *                               "fulltime": "兼任",
    *                               "rank": "講師",
    *                               "specialty": "體操、籃球、排球",
    *                               "remark": "限多媒體學院"
    *                           },
    *                      "TimeStamp": "2023-09-07T03:50:16.208984+08:00 CST"
    *                   }
    *              )
    *          )}
    *      )
    * )
    */
    public function update(UpdateLecturerRequest $request , $id)
    {
        $lecturer = Lecturer::find($id);

        if(!empty($lecturer)){
            $data = array(
                'name' => $request->name,
                'department' => $request->department,
                'fulltime' => $request->fulltime,
                'rank' => $request->rank,
                'specialty' => $request->specialty,
                'remark' => $request->remark,
            );

            if($lecturer->update($data)){
                $updateLecturer = fractal(Lecturer::find($id), new LecturerUpdateTransformer);

                return $this->respondSuccess($updateLecturer);
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
    *      path="/api/lecturer/delete/{id}",
    *      summary="刪除講師",
    *      description="暫無描述。",
    *      tags={"Lecturer"},
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
    *                      "Data": "陳媒體講師已刪除。",
    *                      "TimeStamp": "2023-09-07T03:48:57.662615+08:00 CST"
    *                   }
    *              )
    *          )}
    *      )
    * )
    */
    public function destroy($id)
    {
        $lecturer = Lecturer::find($id);

        if(!empty($lecturer)){
            if($lecturer->delete()){
                $message = $lecturer->name.'講師已刪除。';
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

    /**
    * @OA\Get(
    *     path="/api/lecturer/lecturer-and-course-list",
    *     summary="取得全部講師任課資料",
    *     description="暫無描述。",
    *     tags={"Lecturer"},
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
    *                         "num": "P0001",
    *                         "name": "李專題",
    *                         "department": "資訊管理系",
    *                         "fulltime": "專任",
    *                         "rank": "助理教授",
    *                         "specialty": "XXXXXXX",
    *                         "remark": "無",
    *                         "children_course": {
    *                               {
    *                                   "id": 1,
    *                                   "num": "2301A001",
    *                                   "name": "專題演講",
    *                                   "credits": 3,
    *                                   "limit_people": 60,
    *                                   "classroom_and_time": "管理學院 資訊大樓201，週二 13:10",
    *                                   "instructors": "李專題",
    *                                   "limit_illustrate": "限資管系,資訊工程系",
    *                                   "required_illustrate": "資訊相關學系必修",
    *                                   "remark": "本課程有期中/期末發表"
    *                               },
    *                               {
    *                                   "id": 2,
    *                                   "num": "2301A002",
    *                                   "name": "資料結構",
    *                                   "credits": 3,
    *                                   "limit_people": 45,
    *                                   "classroom_and_time": "管理學院 資訊大樓202，週一 09:10",
    *                                   "instructors": "李專題",
    *                                   "limit_illustrate": "限資管系,資訊工程系",
    *                                   "required_illustrate": "資訊相關學系必修",
    *                                   "remark": "無"
    *                               }
    *                          }
    *                       },
    *                       {
    *                         "id": 2,
    *                         "num": "P0002",
    *                         "name": "黃電子",
    *                         "department": "電子工程系",
    *                         "fulltime": "專任",
    *                         "rank": "教授",
    *                         "specialty": "XXXXXXX",
    *                         "remark": "無",
    *                         "children_course": {
    *                               {
    *                                   "id": 3,
    *                                   "num": "2301B001",
    *                                   "name": "電子學",
    *                                   "credits": 3,
    *                                   "limit_people": 40,
    *                                   "classroom_and_time": "工程學院 電子系大樓201，週二 13:10",
    *                                   "instructors": "黃電子",
    *                                   "limit_illustrate": "限工程學院所有科系",
    *                                   "required_illustrate": "電子系必修",
    *                                   "remark": "本課程為18週課程"
    *                               }
    *                          }
    *                       }
    *                     },
    *                     "TimeStamp": "2023-09-07T03:15:53.188607+08:00 CST"
    *                 }
    *              )
    *          )}
    *     )
    * )
    */
    public function listAndCourse(Request $request)
    {
        try{
            $lecturer = Lecturer::query();

            $listLecturer = fractal($lecturer->get(), new LecturerListAndCourseTransformer)->toArray();

            return $this->respondSuccess($listLecturer);
        }catch(Exception $e){
            $message = "發生未知的錯誤：".$e->getMessage();
            $status_code = 500;
            return $this->respondError($message,$status_code);
        }
    }
}
