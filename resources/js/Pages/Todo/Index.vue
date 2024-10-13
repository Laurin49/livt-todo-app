<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
const props = defineProps({
    todos: {
        type: Object,
        required: true,
    },
    query: {
        type: Object,
        default: () => ({
            search: "",
        }),
    },
});
const handleSearch = (event) => {
    router.get(route("todos.index"), {
        search: event.target.value,
    });
};

const deleteRow = (id) => {
    if (window.confirm("Are you sure?")) {
        router.delete(route("todos.destroy", id), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <Head title="Manage Todos" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Manage Todos
                </h2>
                <Link
                    :href="route('todos.create')"
                    class="px-3 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                    >New Todo
                </Link>
            </div>
        </template>
        <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="flex flex-wrap items-center justify-end pb-6 space-y-4 flex-column sm:flex-row sm:space-y-0"
                >
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 flex items-center pointer-events-none rtl:inset-r-0 rtl:right-0 ps-3"
                        >
                            <svg
                                class="w-5 h-5 text-gray-500"
                                aria-hidden="true"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </div>
                        <input
                            type="text"
                            id="table-search"
                            @keydown.enter="handleSearch"
                            :value="props.query.search"
                            class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search for items"
                        />
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table
                        class="w-full text-sm text-left text-gray-500 rtl:text-right"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase border-b bg-gray-50"
                        >
                            <tr>
                                <th scope="col" class="px-6 py-3">ID</th>
                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Category</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(todo, index) in todos.data"
                                :key="todo.id"
                            >
                                <td class="px-6 py-4">
                                    {{ todos.meta.from + index }}
                                </td>
                                <td class="px-6 py-4">{{ todo.name }}</td>
                                <td class="px-6 py-4">{{ todo.category.name }}</td>
                                <td class="px-6 py-4 space-x-2">
                                    <Link
                                        :href="route('todos.show', todo.id)"
                                        class="font-medium text-gray-600 hover:underline"
                                        >Show
                                    </Link>
                                    <Link
                                        :href="route('todos.edit', todo.id)"
                                        class="font-medium text-blue-600 hover:underline"
                                        >Edit
                                    </Link>
                                    <a
                                        href="#"
                                        @click.prevent="deleteRow(todo.id)"
                                        class="font-medium text-red-600 hover:underline"
                                        >Delete
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :meta="todos.meta" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
