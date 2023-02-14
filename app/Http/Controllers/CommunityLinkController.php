<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommynityLinkForm;
use App\Models\Channel;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel = null)

    {
        // dd($channel->title);
        $channels = Channel::orderBy('title', 'asc')->get();

        if ($channel === null) {
            $links = CommunityLink::where('approved', true)->latest('updated_at')->paginate(25);
        } else {
            $links = CommunityLink::join('channels', 'community_links.channel_id', '=', 'channels.id')
                ->where('approved', true)->where("channels.slug", $channel["slug"])->latest('community_links.updated_at')
                ->paginate(25);
        }

        return view('community/index', compact('links', 'channels', 'channel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommynityLinkForm $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'link' => 'required|active_url', //esto me falla
            'channel_id' => 'required|exists:channels,id'
        ]);
        /////
        $approved = Auth::user()->trusted ? true : false;
        $request->merge(['user_id' => Auth::id(), 'approved' => $approved]);
        /////
        CommunityLink::create($request->all());

        if ($approved) {
            //////////////////////////////////////////////////////
            $link = new CommunityLink();
            $link->user_id = Auth::id();
            /////////////// P R O B L E M A  C O N  M E T O D O ////////////////
            if ($link->hasAlreadyBeenSubmitted($request->link)) {
                return back()->with('success', 'Link update successfully!');
            } else {
                CommunityLink::create($request->all());
                return back()->with('success', 'Link created successfully!');
            }
        } else {
            CommunityLink::create($request->all());
            ///////////////////////////////////////////////////////
            return back()->with('warning', 'Link created successfully but u are not approved');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function show(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function edit(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommunityLink  $communityLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommunityLink $communityLink)
    {
        //
    }
}
