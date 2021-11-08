<template>
  <div>
      <SfModal
      label="Create Product"
      :visible="openModal"
      @close="toggleModal"
      >
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
              v-model="lastName"
              name="last-name"
              label="Description"
              class="form__element"
            />
            <SfInput
              v-model="email"
              name="email"
              label="Price"
              class="form__element"
              type="email"
            />
            <SfInput
              v-model="password"
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
  </div>
</template>

<script>
import {
  SfModal,
  SfInput,
  SfButton
} from "@storefront-ui/vue";
export default {
  name: "Login",
  components: {
    SfModal,
    SfInput,
    SfButton
  },
  data() {
    return {
      isLogIn: true,
      email: "",
      password: "",
      createAccount: false,
      rememberMe: false,
      firstName: "",
      lastName: "",
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

<style lang="scss" scoped>
@import "../UI/styles/AddProduct.scss";
</style>