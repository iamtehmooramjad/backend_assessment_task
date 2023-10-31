@php use Carbon\Carbon; @endphp
@extends('layouts.app')

@section('content')
    <div class="tasks-container">

        <div class="row d-flex justify-content-center mt-5 ">

            <div class="col-md-8">
                <div class="card">

                    <div class="d-flex justify-content-between align-items-center tasks-header">

                        <span class="font-weight-bold">Weekly Tasks</span>

                        <div class="d-flex flex-row">

                            <button class="btn btn-primary mr-2 active">Active</button>
                            <button class="btn btn-primary new"><i class="fa fa-plus"></i> New</button>

                        </div>

                    </div>

                    <form class="mt-3 inputs form-inline" method="GET" action="{{ url('/tasks')}}">
                        <label>
                            <i class="fa fa-search"></i>
                            <input type="search" name="name" class="form-control " placeholder="Search Tasks...">
                        </label>
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"> Search</button>

                    </form>

                        @foreach ($tasks as $task)
                         <div class="mt-3">

                            @php
                                $nameParts = explode(' ', $task->user->name);
                                $name = strtoupper(substr($nameParts[0], 0, 2));
                                $updatedTime = Carbon::parse($task->updated_at);
                                $currentTime = Carbon::now();
                                $elapsedTime = $updatedTime->diffForHumans($currentTime);

                                $viewed = Carbon::parse($task->viewed);
                                $viewed = $viewed->diffForHumans($currentTime);
                            @endphp

                             <a href="{{url('/')}}/tasks/{{$task->id}}" >
                            <div class="d-flex justify-content-between align-items-center task-item">
                                <div class="d-flex flex-row align-items-center">
                                    <span class="star"><i class="bi bi-star-fill yellow"></i></span>
                                    <div class="d-flex flex-column">
                                        <span class="name">{{ $task->name }}</span>
                                        <div class="d-flex flex-row align-items-center time-text">
                                            <small class="description">{{ $task->description }}</small>
                                            <span class="dots"></span>
                                            <small>Viewed {{$viewed}}</small>
                                            <span class="dots"></span>
                                            <small>Edited {{ $elapsedTime }}</small>
                                        </div>
                                    </div>
                                </div>
                                <span class="content-text-1">{{$name}}</span>
                            </div>
                             </a>
                            </div>


                        @endforeach

                    <div class="paging mt-3 align-self-center">
                        {{$tasks->links()}}
                    </div>


                </div>

            </div>


        </div>


    </div>
@endsection
