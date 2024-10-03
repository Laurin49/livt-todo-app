<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import TodoForm from "./TodoForm.vue";

const props = defineProps({
    categories: {
        type: Array,
        required: true,
    },
    todo: {
      type: Object,
      required: true
    }
});

const form = useForm({
    id: props.todo.id,
    name: props.todo.name,
    category_id: props.todo.category.id,
    description: props.todo.description,
    prior: props.todo.prior,
    erledigt: props.todo.erledigt === 1 ? true : false
});

const update = () => {
    form.put(route("todos.update", form.id), {
        onSuccess: () => form.reset(),
    });
};

const deleteRow = (id) => {
    if (window.confirm("Are you sure?")) {
        router.delete(route('todos.destroy', id), {
            preserveScroll: true
        })
    }
}
</script>

<template>
    <Head title="Update Todo" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Update Todo
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
                            @submit="update"
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
