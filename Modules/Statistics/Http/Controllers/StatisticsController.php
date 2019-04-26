<?php

namespace Modules\Statistics\Http\Controllers;

use App\Http\Controllers\BaseController;

class StatisticsController extends BaseController
{
    /**
     * @apiDefine RestfulSuccess
     *
     * @apiSuccessExample {json} 成功请求
     *      // 200 对成功的 GET、PUT、PATCH 或 DELETE 操作进行响应。也可以被用在不创建新资源的 POST 操作上
     *      HTTP/1.1 200 OK
     *      {}
     *
     * @apiSuccessExample {json} 创建成功
     *      // 对创建新资源的 POST 操作进行响应。应该带着指向新资源地址的 Location 头
     *      HTTP/1.1 201 Created
     *      {}
     */

    /**
     * @apiDefine RestfulError
     *
     * @apiErrorExample   {json} 400 请求异常
     *      HTTP/1.1 400 Bad Request
     *      {
     *          "error": {
     *              "message": "提示语",
     *              "status_code": 400
     *          }
     *      }
     *
     * @apiErrorExample   {json} 401 权限错误
     *      HTTP/1.1 401 Unauthorized
     *      Unauthorized.
     *
     * @apiErrorExample   {json} 403 拒绝执行
     *      // 服务器已经理解请求，但是拒绝执行它
     *      HTTP/1.1 403 Forbidden
     *      {
     *          "error": {
     *              "message": "提示语",
     *              "status_code": 403
     *          }
     *      }
     *
     * @apiErrorExample   {json} 405 请求方式错误
     *      // 所请求的 HTTP 方法不允许当前认证用户访问
     *      HTTP/1.1 405 Method Not Allowed
     *      {
     *          "error": {
     *              "message": "Method Not Allowed",
     *              "status_code": 405
     *          }
     *      }
     *
     * @apiErrorExample   {json} 410 资源不存在
     *      // 表示当前请求的资源不再可用。当调用老版本 API 的时候很有用
     *      HTTP/1.1 410 Gone
     *      {
     *          "error": {
     *              "message": "Gone",
     *              "status_code": 410
     *          }
     *      }
     *
     * @apiErrorExample   {json} 415 内容错误
     *      // 如果请求中的内容类型是错误的
     *      HTTP/1.1 415 Unsupported Media Type
     *      {
     *          "error": {
     *              "message": "Unsupported Media Type",
     *              "status_code": 415
     *          }
     *      }
     *
     * @apiErrorExample   {json} 422 参数错误
     *      HTTP/1.1 422 Unprocessable Entity
     *      {
     *          "error": {
     *              "message": "422 Unprocessable Entity",
     *              "errors": [
     *                  {
     *                      "field": "province_id",
     *                      "code": "missing_province id"
     *                  },
     *                  {
     *                      "field": "city_id",
     *                      "code": "missing_city id"
     *                  },
     *                  {
     *                      "field": "zone_id",
     *                      "code": "missing_zone id"
     *                  }
     *              ],
     *          }
     *      }
     *
     * @apiErrorExample   {json} 429 请求频率过高
     *      // 由于请求频次达到上限而被拒绝访问
     *      HTTP/1.1 429 Too Many Requests
     *      {
     *          "error": {
     *              "message": "Too Many Requests",
     *              "status_code": 429
     *          }
     *      }
     *
     *
     */

    /**
     * @apiDefine AuthJSONHeader
     *
     * @apiHeader {String} Authorization="Bear [access_token]" 请求令牌
     * @apiHeader {String} Accepts="application/prs.gbcloud.v1+json"  接口版本 默认v1
     *
     */

    /**
     * 账号登录
     *
     * @api               {POST} /api/user/authorizations 账号登录
     * @apiSampleRequest  /api/user/authorizations
     * @apiVersion        1.0.0
     * @apiDescription
     * 开发者: 郭翔
     *
     * @apiGroup          auth
     * @apiName           apiGuard
     *
     * @apiParam {String} username 用户名 (必传)
     * @apiParam {String} password 密码 (必传)
     *
     * @apiSuccessExample {json} 200 成功请求
     *      HTTP/1.1 200 OK
     *      {
     *          "token_type": "Bearer",
     *          "expires_in": 31536000,
     *          "access_token":
     *     "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI3OWM4MzNkMzAwMTZmMDE1YTkzZTNlMWI0NTNkMDA4ODY1OGI1NWNkOWYwMTQyM2I4NmY2YmVlNWZlYWViZWE3MGEwOGM2MDAyMDYyZTY5In0.eyJhdWQiOiIyIiwianRpIjoiMjc5YzgzM2QzMDAxNmYwMTVhOTNlM2UxYjQ1M2QwMDg4NjU4YjU1Y2Q5ZjAxNDIzYjg2ZjZiZWU1ZmVhZWJlYTcwYTA4YzYwMDIwNjJlNjkiLCJpYXQiOjE1MTkzODE0NjYsIm5iZiI6MTUxOTM4MTQ2NiwiZXhwIjoxNTUwOTE3NDY2LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.TY0ba3UNCaINUTF5J6NOc5JGeBhDF9t8yyoUhDFK9ZErn7ih-O8XMVDg9LSVOy2DDCO9K3Vlsfdkr3KrWhycw9WDsj7MjMyz4sx79Z1inUUFjA9ogK945DLHCTNbo1Gay-kXY06al3o_4yzwC-LY_meTsFDEUbmYcQZ_JiB3E5VNPlF3Ed0QMlZ6gkTY41xWRaq9hhcdoNLUZ8GVZrsKjrBEKWrYcoVGX0LSPm5M16C3Ei2pAWiwonigKSOEis5yQ80nL9ryDCTFn29KJLVWxhxJUmD05I4jNdi_hvdk2aPPdpjjEH3Kvrk64HBYzeIAjpoyUpejkRzsbCBMDFD45xSXOmlZXU4dBci5rAxjpR8aXf3VOI1j2LMC3KB1bTUXDwfy-3I4ZNFJkyA8K3eZyMOj_e_x03m1r1dOmZeQitFpCT0SI8CPWnVKZAUGUF8-eT0L1eIc-y3G5x3-ghaM2soXFTigJYQ-7a6zA9oM2pp1p2jsOcPp3VgTZzNzKAiJjfIa_47yTqTjjT2UKHtzKG1Bq7AQSO8QxybK4nQcKOaSH9rCEebahLeb6NUME1JvkkVJWHCgOjWSuifkK7YE-zXrl5DeYnD7Cy9u1ODJkGDbs1OLLuI8Ojn7_71DNTnHZkXGFzsdM3K5gRwmZ16FZSntz6GcG86byJafglP1xNM",
     *          "refresh_token":
     *     "def50200d5bc2864461a5e6e7103f1987b46df5eb9a5819ce670fc3873268681aff0559048bdcefc95f0490e864adf2c0dd812fdbf8198dfb98729aaec600b5b356e5e0b13e2d06833642cb3ccd4fbe89670a10e16059105d6f03095749b539293f66dd32c83d949e6d3d134984001d8357fbdf77c9660154b6b26e4e11ccb3a562e5207bf1c8c4fbd893512daaede51d7a1c14107f6c604c9c8af9d24dbfdce0383ab4199874b715df70b0dddaf4916bb170093881ea6cc93f5f931d1489e0bfb6535125dcc8a352586d3863f547998cabf2a2a6a5867ec8ede6a2266645bc4656a58debdf2afe066ee6e991a1a349673798f017fe197ddfd2e14772dd118c7e9228e0e52d8a76b59a23ba56e25e9e4231b27da0c13b70e208fcac94e638b699e010a5060a5aa683b56e6d66c01d34bc4d79c8a07519a8e910eeac3e857e7d4207f2d53f4f124b5c3662c117fe10712543da89daddb8173b2325875c8e9a6daed"
     *      }
     *
     * @apiUse            RestfulError
     */

    /**
     * 刷新令牌接口
     *
     * @api               {POST} /oauth/token 刷新令牌接口
     * @apiSampleRequest  /oauth/token
     * @apiVersion        1.0.0
     * @apiDescription
     * developed by 郭翔
     *
     * @apiGroup          Oauth
     * @apiName           refreshToken
     *
     * @apiParam {Integer} refresh_token 刷新令牌 (必传)
     * @apiParam {Integer} client_id 客户端ID (必传)
     * @apiParam {Integer} client_secret 客户端密锁 (必传)
     * @apiParam {Integer} grant_type API验证模式 - 用"pasword" (必传)
     * @apiParam {Integer} provider 登录模式 (必传) - 86账号用"api", 快速注册账号用"flash-user"
     *
     * @apiSuccessExample {json} 200 成功请求
     *      HTTP/1.1 200 OK
     *      {
     *          "token_type": "Bearer",
     *          "expires_in": 31536000,
     *          "access_token":
     *     "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjI3OWM4MzNkMzAwMTZmMDE1YTkzZTNlMWI0NTNkMDA4ODY1OGI1NWNkOWYwMTQyM2I4NmY2YmVlNWZlYWViZWE3MGEwOGM2MDAyMDYyZTY5In0.eyJhdWQiOiIyIiwianRpIjoiMjc5YzgzM2QzMDAxNmYwMTVhOTNlM2UxYjQ1M2QwMDg4NjU4YjU1Y2Q5ZjAxNDIzYjg2ZjZiZWU1ZmVhZWJlYTcwYTA4YzYwMDIwNjJlNjkiLCJpYXQiOjE1MTkzODE0NjYsIm5iZiI6MTUxOTM4MTQ2NiwiZXhwIjoxNTUwOTE3NDY2LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.TY0ba3UNCaINUTF5J6NOc5JGeBhDF9t8yyoUhDFK9ZErn7ih-O8XMVDg9LSVOy2DDCO9K3Vlsfdkr3KrWhycw9WDsj7MjMyz4sx79Z1inUUFjA9ogK945DLHCTNbo1Gay-kXY06al3o_4yzwC-LY_meTsFDEUbmYcQZ_JiB3E5VNPlF3Ed0QMlZ6gkTY41xWRaq9hhcdoNLUZ8GVZrsKjrBEKWrYcoVGX0LSPm5M16C3Ei2pAWiwonigKSOEis5yQ80nL9ryDCTFn29KJLVWxhxJUmD05I4jNdi_hvdk2aPPdpjjEH3Kvrk64HBYzeIAjpoyUpejkRzsbCBMDFD45xSXOmlZXU4dBci5rAxjpR8aXf3VOI1j2LMC3KB1bTUXDwfy-3I4ZNFJkyA8K3eZyMOj_e_x03m1r1dOmZeQitFpCT0SI8CPWnVKZAUGUF8-eT0L1eIc-y3G5x3-ghaM2soXFTigJYQ-7a6zA9oM2pp1p2jsOcPp3VgTZzNzKAiJjfIa_47yTqTjjT2UKHtzKG1Bq7AQSO8QxybK4nQcKOaSH9rCEebahLeb6NUME1JvkkVJWHCgOjWSuifkK7YE-zXrl5DeYnD7Cy9u1ODJkGDbs1OLLuI8Ojn7_71DNTnHZkXGFzsdM3K5gRwmZ16FZSntz6GcG86byJafglP1xNM",
     *          "refresh_token":
     *     "def50200d5bc2864461a5e6e7103f1987b46df5eb9a5819ce670fc3873268681aff0559048bdcefc95f0490e864adf2c0dd812fdbf8198dfb98729aaec600b5b356e5e0b13e2d06833642cb3ccd4fbe89670a10e16059105d6f03095749b539293f66dd32c83d949e6d3d134984001d8357fbdf77c9660154b6b26e4e11ccb3a562e5207bf1c8c4fbd893512daaede51d7a1c14107f6c604c9c8af9d24dbfdce0383ab4199874b715df70b0dddaf4916bb170093881ea6cc93f5f931d1489e0bfb6535125dcc8a352586d3863f547998cabf2a2a6a5867ec8ede6a2266645bc4656a58debdf2afe066ee6e991a1a349673798f017fe197ddfd2e14772dd118c7e9228e0e52d8a76b59a23ba56e25e9e4231b27da0c13b70e208fcac94e638b699e010a5060a5aa683b56e6d66c01d34bc4d79c8a07519a8e910eeac3e857e7d4207f2d53f4f124b5c3662c117fe10712543da89daddb8173b2325875c8e9a6daed"
     *      }
     *
     * @apiUse            RestfulError
     */
}
