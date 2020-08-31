<template>
  <div id="form-group">
    <label>
      {{label}}
      <select
        :value="value"
        required
        @input="$emit('input', $event.target.value)"
        >
        <option value="" disabled hidden>Selecione uma Opção</option>
        <option v-for="option in options" :key="option.value" :value="option.value">
          {{option.label}}
        </option>
      </select>
    </label>
  </div>
</template>

<script>
export default {
  props: {
    type: String,
    label: String,
    value: String,
    options: Array,

  },
};
</script>
<style  scoped >
#form-group label {
  display: flex;
  flex-direction: column;
  margin-bottom: 1.5rem;
}

#form-group label select {
  /* height: 2.5rem; */
  /* width: 100%; */
  padding: 1rem;
  border-radius: 5px;
  border: 1px solid grey;
  margin-top: 0.4rem;
  font-size: 1rem;
}

</style>