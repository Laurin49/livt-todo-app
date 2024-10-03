<script setup>
defineProps({
    form: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});
const emit = defineEmits(["submit"]);
</script>

<template>
    <form
        class="relative bg-white rounded-lg shadow"
        @submit.prevent="emit('submit')"
    >
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-6">
                    <label
                        for="name"
                        class="block mb-2 text-sm font-medium"
                        :class="{
                            'text-gray-900': !form.errors.name,
                            'text-red-700': form.errors.name,
                        }"
                        >Todo name</label
                    >
                    <input
                        type="text"
                        name="name"
                        v-model="form.name"
                        id="name"
                        class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        :class="{
                            'bg-red-50 border-red-500 text-red-900':
                                form.errors.name,
                            'bg-gray-50 border-gray-300 text-gray-900':
                                !form.errors.name,
                        }"
                    />
                    <div
                        class="mt-2 text-red-500 font-sm"
                        v-if="form.errors.name"
                    >
                        {{ form.errors.name }}
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label
                        for="category_id"
                        class="block mb-2 text-sm font-medium"
                        :class="{
                            'text-gray-900': !form.errors.category_id,
                            'text-red-700': form.errors.category_id,
                        }"
                        >Category</label
                    >
                    <select
                        name="category_id"
                        v-model="form.category_id"
                        id="category_id"
                        class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        :class="{
                            'bg-red-50 border-red-500 text-red-900':
                                form.errors.category_id,
                            'bg-gray-50 border-gray-300 text-gray-900':
                                !form.errors.category_id,
                        }"
                    >
                        <option value="">Select a category</option>
                        <option
                            v-for="category in categories"
                            :key="category.id"
                            :value="category.id"
                        >
                            {{ category.name }}
                        </option>
                    </select>
                    <div
                        class="mt-2 text-red-500 font-sm"
                        v-if="form.errors.category_id"
                    >
                        {{ form.errors.category_id }}
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <label
                        for="description"
                        class="block mb-2 text-sm font-medium"
                        :class="{
                            'text-gray-900': !form.errors.description,
                            'text-red-700': form.errors.description,
                        }"
                        >Description</label
                    >
                    <textarea
                        name="description"
                        v-model="form.description"
                        id="description"
                        class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        rows="3"
                        :class="{
                            'bg-red-50 border-red-500 text-red-900':
                                form.errors.description,
                            'bg-gray-50 border-gray-300 text-gray-900':
                                !form.errors.description,
                        }"
                    ></textarea>
                    <div
                        class="mt-2 text-red-500 font-sm"
                        v-if="form.errors.description"
                    >
                        {{ form.errors.description }}
                    </div>
                </div>
                <div class="col-span-1 sm:col-span-1">
                    <label
                        for="prior"
                        class="block mb-2 text-sm font-medium"
                        :class="{
                            'text-gray-900': !form.errors.prior,
                            'text-red-700': form.errors.prior,
                        }"
                        >Priorität</label
                    >
                    <input
                        name="prior"
                        v-model="form.prior"
                        id="prior"
                        type="number"
                        class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                        :class="{
                            'bg-red-50 border-red-500 text-red-900':
                                form.errors.prior,
                            'bg-gray-50 border-gray-300 text-gray-900':
                                !form.errors.prior,
                        }"
                    />
                    <div
                        class="mt-2 text-red-500 font-sm"
                        v-if="form.errors.prior"
                    >
                        {{ form.errors.prior }}
                    </div>
                </div>
                <div class="col-span-1 sm:col-span-1">
                    <label
                        for="erledigt"
                        class="block mb-2 text-sm font-medium"
                        :class="{
                            'text-gray-900': !form.errors.erledigt,
                            'text-red-700': form.errors.erledigt,
                        }"
                        >Erledigt</label
                    >
                    <input
                        name="erledigt"
                        v-model="form.erledigt"
                        id="erledigt"
                        type="checkbox"
                        class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 p-2.5 align-middle items-center"
                        :class="{
                            'bg-red-50 border-red-500 text-red-900':
                                form.errors.erledigt,
                            'bg-gray-50 border-gray-300 text-gray-900':
                                !form.errors.erledigt,
                        }"
                    />
                    <div
                        class="mt-2 text-red-500 font-sm"
                        v-if="form.errors.erledigt"
                    >
                        {{ form.errors.erledigt }}
                    </div>
                </div>
                <div class="col-span-6 space-x-2 sm:col-span-6">
                    <slot />
                </div>
            </div>
        </div>
    </form>
</template>
