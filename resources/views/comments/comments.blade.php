@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')

    <div class="comments-container">


        <div class="row d-flex justify-content-center mt-5 ">

            <div class="col-md-8">
                <div class="card">

                    <div class="d-flex justify-content-between align-items-center task-item">
                        <div class="d-flex flex-row align-items-center">
                            <div class="d-flex flex-column">
                                <h4 class="name">Task : {{ $task->name }}</h4>
                                <div >
                                    <p class="description">Task Description: {{ $task->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 class="content-text-1">By : {{ $task->user->name}}</h6>
                    <br>

                    @foreach ($comments as $comment)

                        @php
                            $createdTime = Carbon::parse($comment->created_at);
                            $currentTime = Carbon::now();
                            $elapsedTime = $createdTime->diffForHumans($currentTime);
                        @endphp

                        <div>
                            <h5>{{$comment->user->name}}</h5>
                            <p>{{ $comment->comment }}</p>
                            <p>{{$elapsedTime}}</p>
                            <hr>
                        </div>

                    @endforeach


                    <form class="mt-3 inputs form-inline" method="post"  action="{{ url('/comments')}}">
                        @csrf
                        <label>
                            <input type="text" name="comment" class="form-control " placeholder="Write...">
                        </label>
                        <input type="hidden" name="task_id" class="form-control"  value="{{$task->id}}">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"> Comment</button>
                    </form>







                </div>

            </div>


        </div>


    </div>
@endsection
