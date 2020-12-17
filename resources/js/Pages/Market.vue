<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Market
      </h2>
    </template>

    <div class="flex flex-col container mx-auto py-12">
      <jet-button
        class="self-end"
        @click.native="showCreateModal = true"
      >
        Create Button
      </jet-button>

      <MarketTable
        :data="products"
        @initEdit="initEdit"
        @initDelete="initDelete"
      />

      <CreateProductModal
        :show="showCreateModal"
        @closeModal="showCreateModal = false"
      />

      <DeleteProductModal
        v-if="selectedProduct"
        :show="showDeleteModal"
        :data="selectedProduct"
        @closeModal="showDeleteModal = false; selectedProduct = null"
      />

      <EditProductModal
        v-if="selectedProduct"
        :show="showEditModal"
        :data="selectedProduct"
        @closeModal="showEditModal = false; selectedProduct = null"
      />
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import JetButton from '@/Jetstream/Button';
import MarketTable from './MarketTable';
import CreateProductModal from './CreateProductModal';
import DeleteProductModal from './DeleteProductModal';
import EditProductModal from './EditProductModal';

import { Inertia } from '@inertiajs/inertia';

export default {
  components: {
    AppLayout,
    JetButton,
    CreateProductModal,
    DeleteProductModal,
    EditProductModal,
    MarketTable,
  },

  props: ['products'],

  data() {
    return {
      showCreateModal: false,
      showEditModal: false,
      showDeleteModal: false,
      selectedProduct: null,
    };
  },

  methods: {
    initDelete(data) {
      this.showDeleteModal = true;
      this.selectedProduct = data;
    },

    initEdit(data) {
      this.showEditModal = true;
      this.selectedProduct = data;
    },
  },
};
</script>
