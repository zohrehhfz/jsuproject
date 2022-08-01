@extends('layouts.my_layout')
@section('title', 'چت')
@section('content')
<x-app-layout>

    <div class="py-12" style="font-size:18px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" dir=rtl style="margin: auto;">
                    <div class="chat-history">
                        <ul>
                            <div class="chat w-100">
                                <!-- end chat-header -->
                                <li class="clearfix">
                                    <div class="">
                                        <div class="float-right">
                                            <div class="d-inline" dir="ltr">
                                                <div class="d-inline">
                                                    <i class="fa fa-circle"></i>
                                                    hh
                                                </div>
                                                <div class="d-inline">
                                                    gg
                                                </div>
                                            </div>
                                            <div class="pl-2">gg</div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="message-data text-left">
                                        <div class="message my-message text-left float-left">
                                            <div class="d-block">
                                                <div class="message-data-name d-inline pl-2">
                                                    <i class="fa fa-circle"></i>yy
                                                </div>
                                                <div class="message-data-time d-inline">
                                                    qq
                                                </div>
                                            </div>
                                            <div class="pl-2">
                                                ww
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- end chat-history -->

                                <!-- end chat-message -->
                            </div>
                        </ul>
                    </div>
                    <!-- end chat -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection