<template>
  <JetDialogModal :show="show">
    <template #title>
      Delete Product
    </template>

    <template #content>
      Are you sure you want to delete <b>{{ data.name }}</b>?
    </template>

    <template #footer>
      <jet-danger-button @click.native="deleteProduct">
        Yes, delete it
      </jet-danger-button>

      <jet-button @click.native="closeModal">
        No, go back
      </jet-button>
    </template>
  </JetDialogModal>
</template>

<script>
import JetDialogModal from '@/Jetstream/DialogModal';
import JetButton from '@/Jetstream/Button';
import JetDangerButton from '@/Jetstream/DangerButton';
import JetLabel from '@/Jetstream/Label';
import JetInput from '@/Jetstream/Input';

export default {
  components: {
    JetDialogModal,
    JetButton,
    JetDangerButton,
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
      form: this.$inertia.form({
        id: this.data.id,
      }),
    };
  },

  methods: {
    deleteProduct() {
      this.form.delete(
        route('market-product.delete', this.data.id),
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
