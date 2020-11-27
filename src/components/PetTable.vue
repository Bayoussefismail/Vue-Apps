<template>
  <div id="">
<h1>{{species}} for Adoption</h1>
  </div>
    <b-table striped hover
           :items="pets"
  >
    <template #cell(name)= "data">
  <router-link :to="`/pets/${species}/${data.index}`">
    {{data.value}}
  </router-link>
    </template>
  </b-table>
</template>
<script>
export default {
  props: {
    species: String,
    pets: Array
  }
}
</script>
