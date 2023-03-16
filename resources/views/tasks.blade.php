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
                    <div class="flex-auto text-2xl mb-4">Tasks List</div>

                    <div class="flex-auto text-right mt-1">
                        <!-- <a href="/tasks/create" class="ml-6 bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-1 px-4 mt-2 rounded">Add new Task</a> -->
                        <button onclick="window.open('/tasks/create')" class="
                                bg-blue-500 hover:bg-blue-700 text-white py-1 px-4 rounded focus:outline-none focus:shadow-outline">Add new Task</button>
                        <form action="/tasks/" onsubmit="return confirm('Do you really want to delete all tasks?')" method="POST" class="inline-flex">
                            <button type="submit" name="delete" class="
                            bg-red-500 hover:bg-red-700 text-white py-1 px-4 ml-1 rounded focus:outline-none focus:shadow-outline">Delete All Tasks</button>
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
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
                        <tr class="border-b hover:bg-orange-100">
                            <td class="py-2 px-5 text-lg">
                                {{ $task->description }}
                            </td>
                            <td class="flex-auto text-right p-6 px-5">

                                <form action="/tasks/{{ $task->id }}" method="POST" class="inline-flex">
                                <button type="submit" name="delete" class="
                                bg-gray-500 hover:bg-gray-700 text-white py-1 px-4 mt-1 ml-1 rounded focus:outline-none focus:shadow-outline">Mark</button>
                                    {{ method_field('PATCH') }}
                                    {{ csrf_field() }}
                                </form>

                                <button onclick="window.open('/tasks/{{ $task->id }}/edit', '_self')" class="
                                bg-blue-500 hover:bg-blue-700 text-white py-1 px-4 mt-1 ml-1 rounded focus:outline-none focus:shadow-outline">Edit</button>

                                <form action="/tasks/{{ $task->id }}" onsubmit="return confirm('Do you really want to delete this option?')" method="POST" class="inline-flex">
                                    <button type="submit" name="delete" class="
                                bg-red-500 hover:bg-red-700 text-white py-1 px-4 mt-1 ml-1 rounded focus:outline-none focus:shadow-outline">Delete</button>
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                </form>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
