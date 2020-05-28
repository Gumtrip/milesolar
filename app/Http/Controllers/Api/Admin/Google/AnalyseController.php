<?php

namespace App\Http\Controllers\Api\Admin\Google;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Google\AnalyseRequest;
use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;
use App\Http\Resources\Google\MostVisitedPagesCollection;
use App\Http\Resources\Google\TopBrowsersCollection;
use App\Http\Resources\Google\TopReferrersCollection;
use App\Http\Resources\Google\TotalVisitorsAndPageViewsCollection;
use App\Http\Resources\Google\UserTypesCollection;
use App\Http\Resources\Google\VisitorsAndPageViewsCollection;
class AnalyseController extends Controller
{

    /**该函数返回一个Collection，其中的每个项目都是一个包含键date，visitor，pageTitle和 pageViews的数组。
     *
     */
    function visitorsAndPageViews(AnalyseRequest $request){
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $period = Period::create($start, $end);
        $analyticsData = Analytics::fetchVisitorsAndPageViews($period);
        return VisitorsAndPageViewsCollection::collection($analyticsData);

    }

    /** 该函数返回一个Collection，其中每个项目都是一个数组，其中包含关键日期，访问者和pageViews
     *
     */
    function totalVisitorsAndPageViews(AnalyseRequest $request){
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $period = Period::create($start, $end);
        $analyticsData = Analytics::fetchTotalVisitorsAndPageViews($period);
        return TotalVisitorsAndPageViewsCollection::collection($analyticsData);
    }

    /** 该函数返回一个Collection，其中每个项目都是一个包含键url，pageTitle和pageViews的数组。
     *
     */
    function mostVisitedPages(AnalyseRequest $request){
        $maxResults = $request->maxResult??20;
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $period = Period::create($start, $end);
        $analyticsData = Analytics::fetchMostVisitedPages($period,$maxResults);
        return MostVisitedPagesCollection::collection($analyticsData);
    }

    /** 该函数返回一个Collection，其中每个项目都是一个包含键url和pageViews的数组。
     *
     */
    function topReferrers(AnalyseRequest $request){
        $maxResults = $request->maxResult??20;
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $period = Period::create($start, $end);
        $analyticsData = Analytics::fetchTopReferrers($period,$maxResults);
        return TopReferrersCollection::collection($analyticsData);

    }
    /** 该函数返回一个Collection，其中每个项目都是一个包含键类型和会话的数组。
     *
     */
    function userTypes(AnalyseRequest $request){
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $period = Period::create($start, $end);
        $analyticsData = Analytics::fetchUserTypes($period);
        return UserTypesCollection::collection($analyticsData);
    }

    /**
     * 该函数返回一个Collection，其中每个项目都是一个包含键浏览器和会话的数组。
     */
    function topBrowsers(AnalyseRequest $request){
        $maxResults = $request->maxResult??10;
        $start = Carbon::parse($request->start);
        $end = Carbon::parse($request->end);
        $period = Period::create($start, $end);
        $analyticsData = Analytics::fetchTopBrowsers($period,$maxResults);
        return TopBrowsersCollection::collection($analyticsData);
    }
}
