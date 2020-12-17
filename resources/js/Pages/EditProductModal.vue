<template>
  <JetDialogModal :show="show">
    <template #title>
      Add New Product
    </template>

    <template #content>
      <div class="flex flex-col container">
        <div class="grid grid-cols-1">
          <jet-label
            for="name"
            value="Product Name"
          />
          <jet-input
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
          />
        </div>

        <div class="grid grid-cols-2 gap-4 mt-2">
          <div>
            <jet-label
              for="price"
              value="Price"
            />
            <jet-input
              id="price"
              type="number"
              class="mt-1 block w-full"
              step="any"
              min="1"
              v-model="form.price"
            />
          </div>

          <div>
            <jet-label
              for="quantity"
              value="Quantity"
            />
            <jet-input
              id="quantity"
              type="number"
              class="mt-1 block w-full"
              step="1"
              min="0"
              v-model="form.quantity"
            />
          </div>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-button @click.native="editProduct">
        Save New Changes
      </jet-button>

      <jet-button @click.native="closeModal">
        Close
      </jet-button>
    </template>
  </JetDialogModal>
</template>

<script>
import JetDialogModal from '@/Jetstream/DialogModal';
import JetButton from '@/Jetstream/Button';
import JetLabel from '@/Jetstream/Label';
import JetInput from '@/Jetstream/Input';

export default {
  components: {
    JetDialogModal,
    JetButton,
    JetLabel,
    JetInput,
  },

  props: {
    show: {
      type: Boolean,
      required: true,
    },
    data: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      form: this.$inertia.form(
        {
          name: this.data.name,
          price: this.data.price,
          quantity: this.data.quantity,
        },
        {
          resetOnSuccess: true,
        },
      ),
    };
  },

  methods: {
    editProduct() {
      this.form.patch(
        route('market-product.update', this.data.id),
        {
          onSuccess: (response) => {
            this.$emit('closeModal');
          },
        },
        {
          preserveScroll: true,
        },
      );
    },

    closeModal() {
      this.$emit('closeModal');
    },
  },
};
</script>
