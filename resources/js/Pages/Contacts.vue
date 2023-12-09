<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {ref} from "vue"
import axios from "axios";
let contact = ref({
  name: "",
  email: "",
  message: "",
});

function sendMessage() {
  if (contact.value.email == "") {
    alert("please add email");
    return;
  }
  axios
    .post("/contact-us", contact.value)
    .then((r) => {
      contact.value = {
        name: "",
        email: "",
        message: "",
      };
    })
    .catch((e) => {
      alert("there was an error" + e);
    });
}
</script>

<template>
  <AppLayout title="Contact us">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Contact us
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
          <div class="mt-3">Name</div>
          <input type="text" v-model="contact.name" />

          <div class="mt-3">Email</div>
          <input type="text" v-model="contact.email" />

          <div class="mt-3">Message</div>
          <textarea rows="4" v-model="contact.message"></textarea>

          <button
            class="mt-3 block border py-2 px-4 bg-slate-100 rounded"
            @click="sendMessage"
          >
            Send message
          </button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>