<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
defineProps({
    categories: {
        type: Array,
        required: true,
    },
});
const deleteRow = (id) => {
    if (window.confirm("Are you sure?")) {
        router.delete(route("categories.destroy", id), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <Head title="Manage Categories" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Manage Categories
                </h2>
                <Link
                    :href="route('categories.create')"
                    class="px-3 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                    >New Category
                </Link>
            </div>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
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
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="category in categories"
                                :key="category.id"
                            >
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                                >
                                    {{ category.id }}
                                </th>
                                <td class="px-6 py-4">{{ category.name }}</td>
                                <td class="px-6 py-4 space-x-2">
                                    <Link
                                        :href="
                                            route(
                                                'categories.show',
                                                category.id
                                            )
                                        "
                                        class="font-medium text-gray-600 hover:underline"
                                        >Show
                                    </Link>
                                    <Link
                                        :href="
                                            route(
                                                'categories.edit',
                                                category.id
                                            )
                                        "
                                        class="font-medium text-blue-600 hover:underline"
                                        >Edit
                                    </Link>
                                    <a
                                        href="#"
                                        @click.prevent="deleteRow(category.id)"
                                        class="font-medium text-red-600 hover:underline"
                                        >Delete
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
