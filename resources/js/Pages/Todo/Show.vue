<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    todo: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head title="Show Todo" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Show Todo
                </h2>
                <Link
                    :href="route('todos.index')"
                    class="px-3 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                    >Manage Todos
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div
                        class="relative w-full max-w-2xl max-h-full bg-white rounded-lg shadow"
                    >
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900"
                                        >Todo name</label
                                    >
                                    <p
                                        class="text-sm text-gray-900 w-full py-2.5"
                                    >
                                        {{ todo.name }}
                                    </p>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900"
                                        >Todo Description</label
                                    >
                                    <p
                                        class="text-sm text-gray-900 w-full py-2.5"
                                    >
                                        {{ todo.description }}
                                    </p>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-900"
                                        >Todo Category</label
                                    >
                                    <p
                                        class="text-sm text-gray-900 w-full py-2.5"
                                    >
                                        {{ todo.category.name }}
                                    </p>
                                </div>
                                <div class="col-span-6 space-x-2 sm:col-span-6">
                                    <Link :href="route('todos.edit', todo.id)"
                                        class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                        >Edit
                                    </Link>
                                    <Link
                                        :href="route('todos.index')"
                                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5"
                                        >Cancel
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
