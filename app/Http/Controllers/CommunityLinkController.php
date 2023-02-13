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
    public function index()
    {
        // POSIBLE ERROR AQUI $links//
        $links = CommunityLink::where('approved', true)->latest('updated_at')->paginate(25);
        $channels = Channel::orderBy('title', 'asc')->get();
        return view('community/index', compact('links', 'channels'));

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
            'link' => 'required|active_url',
            'channel_id' => 'required|exists:channels,id'
        ]);
        /////
        $approved = Auth::user()->trusted ? true : false;
        $request->merge(['user_id' => Auth::id(), 'approved' => $approved]);
        /////
        CommunityLink::create($request->all());

        if ($approved ) {
            return back()->with('success','Link created successfully');
            //////////////////////////////////////////////////////
            if(CommunityLink::hasAlreadyBeenSubmitted($request['link'])){
                CommunityLink::hasAlreadyBeenSubmitted($request['link']);
                return back()->with('success','Link updated successfully');
            }else{
                CommunityLink::create($request->all());
                return back()->with('success','Link created successfully');
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