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
                        <a href="/task" class="ml-6 bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-1 px-4 mt-2 rounded">Add new Task</a>
                    </div>
                </div>
                <table class="w-full text-md rounded mb-4">
                    <thead>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5 p-2 px-4 pl-3">Task</th>
                        <th class="text-left p-3 px-5 p-2 px-4 pl-3">Actions</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(auth()->user()->tasks as $task)
                        <tr class="border-b hover:bg-orange-100">
                            <td class="py-2 px-5">
                                {{ $task->description }}
                            </td>
                            <td class="p-6 px-5">

                                <a href="/task/{{ $task->id }}" name="edit" class="
                                mb-4 bg-indigo-500 hover:bg-indigo-600 text-white py-1 px-4 rounded focus:outline-none focus:shadow-outline">Edit</a>
                                <form action="/task/{{ $task->id }}" class="inline-flex">
                                    <button type="submit" name="delete" formmethod="POST" style="padding: 2px 14px" class="
                                mt-2 bg-red-500 hover:bg-red-600 text-white py-1 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
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
