<template>
  <div class="hello">
    <Listing />

    <SfModal label="Create Product" :visible="openModal" @close="toggleModal">
      <transition name="sf-fade" mode="out-in">
        <div>
          <form class="form" @submit.prevent="() => false">
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
              type="email"
            />
            <SfInput
              v-model="image"
              name="password"
              label="Image"
              type="file"
              class="form__element"
            />
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

    <SfBottomNavigation>
      <SfBottomNavigationItem
        icon=""
        :isActive="false"
        iconActive=""
        label=""
        iconSize="20px"
      />
      <SfBottomNavigationItem
        icon="menu"
        :isActive="false"
        iconActive="menu"
        label="Products Listing"
        iconSize="20px"
      />
      <SfBottomNavigationItem
        class="open-button"
        data-testid="open-modal-button"
        @click="toggleModal"
        icon="plus"
        label="Add Product"
        isFloating=""
      />
    </SfBottomNavigation>
  </div>
</template>

<script>
import Listing from "./screens/Listing";
import {
  SfBottomNavigation,
  SfModal,
  SfInput,
  SfButton,
} from "@storefront-ui/vue";

export default {
  name: "HelloWorld",
  props: {
    msg: String,
  },
  components: {
    Listing,
    SfBottomNavigation,
    SfModal,
    SfInput,
    SfButton,
  },
  data() {
    return {
      name: "",
      description: "",
      price: "",
      image: "",
      openModal: false,
    };
  },
  methods: {
    toggleModal() {
      this.openModal = !this.openModal;
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style lang="scss" scoped>
@import "./UI/styles/AddProduct.scss";
</style>