<template>
  <div id="form-group">
    <label>
      {{label}}
      <input
        :type="type || 'text'"
        :value="value"
        required
        @input="$emit('input', $event.target.value)"
      />
    </label>
  </div>
</template>

<script>
export default {
  name: "Input",
  props: {
    type: String,
    label: String,
    value: String,
  },
};
</script>
<style  scoped >
#form-group label {
  display: flex;
  flex-direction: column;
  margin-bottom: 1.5rem;
}

#form-group label input {
  /* height: 2.5rem; */
  /* width: 100%; */
  padding: 1rem;
  border-radius: 5px;
  border: 1px solid grey;
  margin-top: 0.4rem;
  font-size: 1rem;
}
#form-group input[type="date"] {
  padding: 0.88rem;
}
</style>