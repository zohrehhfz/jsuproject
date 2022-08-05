@extends('layouts.my_layout')
@section('title', 'چت')
@section('content')
<x-app-layout>

    <div class="py-12" style="font-size:18px;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200" dir=rtl style="margin: auto; background-color: #E5EAEE  ;">
                    <div class="chat-history">
                        <ul>
                          
                            <div class=" w-100">
                                @foreach($chats as $message)
                                <?php
                                $user1 = $message->user;
                                $photo_url = Storage::url('public/files/' . $user1->photoname);
                                $name = $user1->name;
                                $travel = $message->travel_id;
                                ?>
                                @if($message->from != $user->id)
                                <li class="clearfix">
                                    <div class="float-right" style="background-color: #A1C4E7  ; border-radius:20px;">
                                        <div class="float-right">
                                            <div class="d-inline" dir="ltr">
                                                <div class="d-inline">
                                                    <i class="fa fa-circle"><?php $v2 = new Verta($message->created_at);
                                                                            print $v2->formatJalaliDate(); ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                        {{$name}}</i>

                                                </div>
                                                <div class="d-inline">
                                                    <?php
                                                    if ($photo_url == "/storage/files/null") {
                                                    ?>
                                                        <img src="/user.gif" class="img-fluid img-circle d-inline" style="margin-right:1vw; width:40px; height:40px;" alt="profile photo Not Set">
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <img src="{{$photo_url}}" class="img-fluid img-circle d-inline" alt="Profile photo UnAvialable" style="margin-right:1vw; width:40px; height:40px;">
                                                    <?php
                                                    }
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="pl-2" style=" text-align: right;">{{$message->message}}</div>
                                            <br>
                                        </div>
                                        <br>
                                    </div>
                                </li>
                                <br>

                                @else
                                <li class="clearfix" style="margin-right: 50vw;">
                                    <div class="float-left" style="    text-align: right; background-color:#C8DBED; border-radius:10px; width: fit-content; margin: auto;">
                                        <div class="float-left">
                                            <div class="d-inline" dir="ltr">
                                                <div class="d-inline">
                                                    <i class="fa fa-circle"> {{$name}} &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php $v2 = new Verta($message->created_at);
                                                                                                                                                        print $v2->formatJalaliDate(); ?>
                                                    </i>
                                                    <?php
                                                    if ($photo_url == "/storage/files/null") {
                                                    ?>
                                                        <img src="/user.gif" class="img-fluid img-circle d-inline" style="margin-right:1vw; width:40px; height:40px;" alt="profile photo Not Set">
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <img src="{{$photo_url}}" class="img-fluid img-circle d-inline" alt="Profile photo UnAvialable" style="margin-right:1vw; width:40px; height:40px;">
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="pb-4" style=" text-align: right;">
                                                    {{$message->message}}
                                                </div>
                                            </div>
                                        </div>
                                </li>
                                <br>
                                @endif
                                @endforeach
                            </div>
                        </ul>
                    </div>
                    <!-- end chat -->
                    <br>
                    <br>
                    <div class="sub_cm" style="background-color:#A1C4E7; width:auto">
                        <div class="row">
                            <form id="commentform" action="{{route('SendMessage')}}" method="post">
                                @csrf
                                <div style="margin-top:2vh; margin-bottom:2vh;">
                                    <input type="hidden" id="travel" name="travel" value={{ $travel }}>
                                    <textarea name="message" id="commentform" cols="110" rows="1" placeholder="پیام خود را بنویسید."></textarea>
                                    <button id="submitbutton" type="submit" style="background-color:#D9E7F3; color:black; width:auto; display:inline; margin:auto;"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                            <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                                        </svg></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection