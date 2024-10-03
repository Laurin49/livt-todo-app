<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, router } from "@inertiajs/vue3";
defineProps({
    todos: {
        type: Array,
        required: true,
    },
});

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
                              v-for="todo in todos"
                              :key="todo.id"
                          >
                              <th
                                  scope="row"
                                  class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                              >
                                  {{ todo.id }}
                              </th>
                              <td class="px-6 py-4">{{ todo.name }}</td>
                              <td class="px-6 py-4 space-x-2">
                                  <Link
                                      :href="
                                          route(
                                              'todos.show',
                                              todo.id
                                          )
                                      "
                                      class="font-medium text-gray-600 hover:underline"
                                      >Show
                                  </Link>
                                  <Link
                                      :href="
                                          route(
                                              'todos.edit',
                                              todo.id
                                          )
                                      "
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
              </div>
          </div>
      </div>
  </AuthenticatedLayout>
</template>