<template>
  <div class="sf-product-card-horizontal">
    <div class="sf-product-card-horizontal__image-wrapper">
      <!--@slot Use this slot to replace image-->
      <slot
        name="image"
        v-bind="{ image, title, link, imageHeight, imageWidth }"
      >
        <SfLink
          :link="link"
          class="
            sf-product-card-horizontal__link
            sf-product-card-horizontal__link--image
          "
        >
          <template v-if="Array.isArray(image)">
            <SfImage
              v-for="(picture, key) in image.slice(0, 2)"
              :key="key"
              class="sf-product-card-horizontal__picture"
              :src="picture"
              :alt="title"
              :width="imageWidth"
              :height="imageHeight"
              :placeholder="productPlaceholder"
            />
          </template>
          <SfImage
            v-else
            class="sf-product-card-horizontal__image"
            :src="image"
            :alt="title"
            :width="imageWidth"
            :height="imageHeight"
            :placeholder="productPlaceholder"
          />
        </SfLink>
      </slot>
    </div>
    <div class="sf-product-card-horizontal__main">
      <div class="sf-product-card-horizontal__details">
        <!--@slot Use this slot to replace title-->
        <slot name="title" v-bind="{ title, link }">
          <SfLink :link="link" class="sf-product-card-horizontal__link">
            <h3 class="sf-product-card-horizontal__title">
              {{ title }}
            </h3>
          </SfLink>
        </slot>
        <!--@slot Use this slot to replace description-->
        <slot name="description">
          <p class="sf-product-card-horizontal__description desktop-only">
            {{ description }}
          </p>
        </slot>
        <!--@slot Use this slot to place content inside configuration-->
        <div class="sf-product-card-horizontal__configuration">
          <slot name="configuration" />
        </div>
      </div>
      <div class="sf-product-card-horizontal__actions-wrapper">
        <!--@slot Use this slot to replace price-->
        <slot name="price" v-bind="{ regularPrice }">
          <SfPrice
            v-if="regularPrice"
            class="sf-product-card-horizontal__price"
            :regular="regularPrice"
          />
        </slot>
      </div>
    </div>
  </div>
</template>
<script>

import {
  SfPrice,
  SfLink,
  SfImage
} from "@storefront-ui/vue";
import productPlaceholder from "../../assets/product_placeholder.svg";

export default {
  name: "SfProductCardHorizontal",
  components: {
    SfPrice,
    SfImage,
    SfLink
  },
  props: {
    description: {
      type: String,
      default: "",
    },
    image: {
      type: [Array, Object, String],
      default: "",
    },
    imageWidth: {
      type: [String, Number],
      default: 140,
    },
    imageHeight: {
      type: [String, Number],
      default: 200,
    },
    title: {
      type: String,
      default: "",
    },
    link: {
      type: [String, Object],
      default: "",
    },
    regularPrice: {
      type: [Number, String],
      default: null,
    }
  },
  data() {
    return {
      productPlaceholder
    };
  }
};
</script>
<style lang="scss">
@import "./styles/SfProductCardHorizontal.scss";
</style>
