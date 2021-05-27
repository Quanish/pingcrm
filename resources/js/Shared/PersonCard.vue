<template>
  <div class="flex">
    <div>
      <img :src="src" alt="" class="w-8 h-8 rounded-full border">
    </div>
    <div class="pl-3">
      <p class="text-black font-normal mt-1">{{ fullname }}</p>
      <p class="text-2xs font-light text-gray-300">{{ job }}</p>
    </div>
  </div>
</template>

<script>
export default {
  model: {
    prop: 'modelValue', 
    event: 'change'
  },
  props: {
    src: { default: "/img/default-user.png" },
    fullname: { default: "Имя Фамилия" },
    job: { default: "Должность" },
  },
  computed: {
    isChecked() {
      if (this.modelValue instanceof Array) {
        return this.modelValue.includes(this.value)
      }
      // Note that `true-value` and `false-value` are camelCase in the JS
      return this.modelValue === this.trueValue
    }
  },
  methods: {
    updateInput(event) {
      let isChecked = event.target.checked
      if (this.modelValue instanceof Array) {
        let newValue = [...this.modelValue]
        if (isChecked) {
          newValue.push(this.value)
        } else {
          newValue.splice(newValue.indexOf(this.value), 1)
        }
        this.$emit('change', newValue)
      } else {
        this.$emit('change', isChecked ? this.trueValue : this.falseValue)
      }
    }
  }
}
</script>

<style lang="css" scoped>

</style>

