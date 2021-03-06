<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller; ///
use App\Models\Sermon; ///
use App\Models\Stagedsermon;
use App\Repositories\Sermon\SermonRepository;
use App\Repositories\Stagedsermon\StagedsermonRepository;
use Illuminate\Http\Request;

class SermonsApiController extends Controller
{
    protected $sermon;
    protected $stagedsermon;

    public function __construct(SermonRepository $sermon, StagedsermonRepository $stagedsermon)
    {
        $this->sermon = $sermon;
        $this->stagedsermon = $stagedsermon;
    }

    public function index()
    {
        return $this->sermon->get30Paginated();
    }

    public function count()
    {
        return $this->sermon->countAll();
    }

    public function stagedsermonCount()
    {
        return $this->stagedsermon->countAll();
    }

    public function getSermonDetails($slug)
    {
        return $this->sermon->getDetails($slug);
    }

    public function sermonCategory($slug)
    {
        return $this->getCategory($slug);
    }

    public function sermonService($slug)
    {
        return $this->getService($slug);
    }

    public function deleteSermon(Sermon $sermon)
    {
        $this->sermon->delete($sermon->slug, $sermon->filename);

        return response('success', 200);
    }

    public function downloadSermon($slug)
    {
        return $this->sermon->download($slug);
    }

    public function stagedsermon()
    {
        return $this->stagedsermon->get10Paginated();
    }

    public function deleteStagedesermon(Stagedsermon $stagedsermon)
    {
        return $this->stagedsermon->delete($stagedsermon->slug, $stagedsermon->filename);
    }

    public function upload(Request $request)
    {
        return $this->stagedsermon->create($request);
    }
}
