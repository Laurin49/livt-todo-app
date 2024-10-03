<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import CategoryForm from "./CategoryForm.vue";
const props = defineProps({
    category: {
        type: Object,
        required: true,
    },
});

const form = useForm({
  id: props.category.id,
  name: props.category.name,
});
const update = () => {
    form.put(route("categories.update", form.id), {
        onSuccess: () => form.reset(),
    });
};
const deleteRow = (id) => {
    if (window.confirm("Are you sure?")) {
        router.delete(route('category.destroy', id), {
            preserveScroll: true
        })
    }
}
</script>

<template>
  <Head title="Edit Categories" />

  <AuthenticatedLayout>
      <template #header>
          <div class="flex items-center justify-between">
              <h2 class="text-xl font-semibold leading-tight text-gray-800">
                  Edit Category
              </h2>
              <Link
                  :href="route('categories.index')"
                  class="font-medium rounded-md text-sm px-5 py-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
                  >Manage Categories</Link
              >
          </div>
      </template>

      <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-center">
                <div class="relative w-full max-w-2xl max-h-full">
                    <CategoryForm
                        :form="form"
                        @submit="update"
                    >
                        <button
                            type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                        >
                            Update
                        </button>
                        <Link
                            :href="route('categories.index')"
                            class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5"
                            >Cancel
                        </Link>
                    </CategoryForm>
                </div>
            </div>
        </div>
    </div>
</AuthenticatedLayout>
</template>
