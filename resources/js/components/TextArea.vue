<template>
  <div id="form-group">
    <label>
      {{label}}
      <textarea
        :value="value"
        required
        @input="$emit('input', $event.target.value)"
      />
    </label>
  </div>
</template>

<script>
export default {
  name: "TextArea",
  props: {
    label: String,
    value: String,
  },
 
  
};
</script>

<style>
#form-group {
  display: flex;
  flex-direction: column;
  margin-bottom: 1.5rem;
}

#form-group label textarea {
  width: 100%;
  /* height: 2.5rem; */
  font-size: 1rem;
  padding: 0.7rem;
  border-radius: 5px;
  border: 1px solid grey;
  margin-top: 0.4rem;
  height:5rem;
}
</style>