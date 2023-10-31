<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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

                                    <div class="mt-3 inputs">
                                        <i class="fa fa-search"></i>
                                        <input type="text" class="form-control " placeholder="Search Tasks...">

                                    </div>

                                    <div class="mt-3">
                                        @foreach ($tasks as $task)
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex flex-row align-items-center">
                                                    <span class="star"><i class="fa fa-star yellow"></i></span>
                                                    <div class="d-flex flex-column">
                                                        <span>{{ $task->name }}</span>
                                                        <div class="d-flex flex-row align-items-center time-text">
                                                            <small>{{ $task->description }}</small>
                                                            <span class="dots"></span>
                                                            <small>Viewed Just now</small>
                                                            <span class="dots"></span>
                                                            <small>Edited {{ $task->updated_at}}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="content-text-1">{{ $task->user->name }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                            </div>


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
