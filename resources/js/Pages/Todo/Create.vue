<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import TodoForm from "./TodoForm.vue";

defineProps({
    categories: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    name: "",
    category_id: "",
    description: "",
    prior: "",
    erledigt: "",
});

const store = () => {
    form.post(route("todos.store"), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <Head title="New Category" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    New Todo
                </h2>
                <Link
                    :href="route('todos.index')"
                    class="font-medium rounded-md text-sm px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
                    >Manage Todos
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <TodoForm
                            :form="form"
                            :categories="categories"
                            @submit="store"
                        >
                            <button
                                type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                            >
                                Save
                            </button>
                            <Link
                                :href="route('todos.index')"
                                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5"
                                >Cancel
                            </Link>
                        </TodoForm>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
