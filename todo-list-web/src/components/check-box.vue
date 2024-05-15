<template>
  <button
    @click="toggleChecked"
    :class="checked ? 'bg-slate-900' : 'bg-transparent'"
    class="ring-[2px] rounded-full flex justify-center items-center h-4 w-4 transition-all"
  >
    <ph-check v-if="checked" class="text-white" size="0.75rem" weight="bold" />
  </button>
</template>

<script>
export default {
  name: 'CheckBox',
  props: {
    checked: Boolean
  },
  methods: {
    toggleChecked() {
      this.$emit('update:checked', !this.checked)
    }
  }
}
</script>
