<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    meta: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <nav
        class="flex flex-wrap items-center justify-between px-4 py-2 flex-column md:flex-row"
        aria-label="Table navigation"
    >
        <span
            class="block w-full mb-4 text-sm font-normal text-gray-700 md:mb-0 md:inline md:w-auto"
            >Showing
            <span class="font-semibold text-gray-700"
                >{{ meta.from }}-{{ meta.to }}</span
            >
            of
            <span class="font-semibold text-gray-700">{{
                meta.total
            }}</span></span
        >
        <ul class="inline-flex h-8 -space-x-px text-sm rtl:space-x-reverse">
            <li v-for="(link, index) in meta.links" :key="index">
                <Link
                    preserve-scroll
                    :href="link.url ?? ''"
                    class="flex items-center justify-center h-8 px-3 ms-0"
                    :class="{
                        'leading-tight text-gray-500 hover:text-gray-700': !link.active,
                        'text-blue-600 hover:text-blue-700': link.active,
                        'text-stone-400 hover:text-stone-400': !link.url,
                    }"
                    
                >
                <div v-html="link.label"></div>
                </Link>
            </li>
        </ul>
    </nav>
</template>
