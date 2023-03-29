<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex">
                    <div class="flex-auto text-2xl mb-4">To Do List</div>
                    <div class="flex-auto text-right mt-1">
                        <button onclick="window.open('/tasks/create', '_self')" class="
                                bg-blue-500 hover:bg-blue-700 text-white py-1 px-4 mb-1 ml-2 rounded focus:outline-none focus:shadow-outline">
                            Add new Task
                        </button>
                        <form action="/tasks" onsubmit="return confirm('Do you really want to delete all tasks?')"
                              method="POST" class="inline-flex">
                            <button type="submit" name="delete" class="
                            bg-red-500 hover:bg-red-700 text-white py-1 px-4 ml-1 rounded focus:outline-none focus:shadow-outline">
                                Delete All Tasks
                            </button>
                            {{ method_field('DELETE') }}
                            @csrf
                        </form>
                    </div>
                </div>
                <table class="w-full text-md rounded mb-4">
                    <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5 p-2 px-4 pl-3">Task</th>
                        <th class="text-right p-3 px-5 p-2 px-4 pl-3">Actions</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(auth()->user()->tasks as $task)
                        <tr id="tr_{{ $task->id }}"
                            class="border-b hover:bg-orange-100 px-0 mx-0 @if($task->marked) bg-gray-100 @endif">
                            <td id="td_{{ $task->id }}" onclick=""
                                class="py-2 px-3 text-lg w-5/6 cursor-pointer @if($task->marked) line-through @endif">
                                {{ $task->description }}
                            </td>
                            <td class="flex-auto w-1/6 text-right p-6 pr-2 w-0">

                                <button onclick="window.open('/tasks/{{ $task->id }}/edit', '_self')" class="bg-blue-500 hover:bg-blue-700 text-white py-1 px-4 mt-1 mr-1 rounded focus:outline-none focus:shadow-outline">Edit</button>

                                <form action="/tasks/{{ $task->id }}" onsubmit="return confirm('Do you really want to delete this option?')" method="POST" class="inline-flex">
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-4 mt-1 mr-1 rounded focus:outline-none focus:shadow-outline">Delete</button>
                                    {{ method_field('DELETE') }}
                                    @csrf
                                </form>

                            </td>
                            <script>
                            $(document).ready(function () {
                                $("#td_{{ $task->id }}").click(function () {
                                    if({{ $task->marked  }} == 1) {
                                        $("#td_{{ $task->id }}").addClass("line-through");
                                        $("#tr_{{ $task->id }}").addClass("bg-gray-100");
                                    } else {
                                        $("#td_{{ $task->id }}").removeClass("line-through");
                                        $("#tr_{{ $task->id }}").removeClass("bg-gray-100");
                                    }
                                    $.ajax({
                                        type: "POST",
                                        url: "/tasks/{{ $task->id }}",
                                        data: {_method: "PATCH"},
                                        headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")},
                                        success: function(data, status) {
                                            if (data == 1) {
                                                $("#td_{{ $task->id }}").addClass("line-through");
                                                $("#tr_{{ $task->id }}").addClass("bg-gray-100");
                                            } else {
                                                $("#td_{{ $task->id }}").removeClass("line-through");
                                                $("#tr_{{ $task->id }}").removeClass("bg-gray-100");
                                            }
                                        }
                                    });
                                });
                            });
                            </script>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
