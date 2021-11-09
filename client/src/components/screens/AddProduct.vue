<template>
  <div>
    <SfModal label="Create Product" :visible="openModal" @close="toggleModal">
      <transition name="sf-fade" mode="out-in">
        <div>
          <form class="form" v-on:submit.prevent="addProduct">
            <SfInput
              v-model="name"
              name="name"
              label="Name"
              class="form__element"
            />
            <SfInput
              v-model="description"
              name="description"
              label="Description"
              class="form__element"
            />
            <SfInput
              v-model="price"
              name="price"
              label="Price"
              class="form__element"
              type="number"
            />
            <input type="file" name="image" id="image" @change="handleFileUpload( $event )" />
            <SfButton
              type="submit"
              class="sf-button--full-width form__submit"
              data-testid="create-acount-button"
            >
              Create a Product
            </SfButton>
          </form>
        </div>
      </transition>
    </SfModal>
  </div>
</template>

<script>
import { SfModal, SfInput, SfButton } from "@storefront-ui/vue";
export default {
  name: "AddProduct",
  components: {
    SfModal,
    SfInput,
    SfButton,
  },
  data() {
    return {
      name: "",
      description: "",
      price: null,
      image: null,
      openModal: true,
    };
  },
  methods: {
    toggleModal() {
      this.openModal = !this.openModal;
    },
    handleFileUpload(event) {
      this.image = event.target.files[0];
      console.log(this.image, 'image');
    },
    async addProduct() {
      try {

        const formData = new FormData();
        formData.append('name', this.name);
        formData.append('description', this.description);
        formData.append('price', this.price);
        formData.append('image', this.image);

        const response = await this.$http.post(
          "http://localhost:8000/api/products",
          formData,
          {
            headers: {
              "Content-Type": "multipart/form-data",
            },
          }
        );
        if (response.status == 201)
        {
          this.toggleModal();
          this.$emit('new-product');
        }
      } catch (error) {
        console.log(error);
      }
    },
  },
  created() {
    this.addProduct();
  },
};
</script>

<style lang="scss" scoped>
@import "../UI/styles/AddProduct.scss";
</style>