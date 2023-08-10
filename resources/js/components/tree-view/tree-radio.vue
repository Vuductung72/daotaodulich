<template>
    <label class="mt-radio" :for="id">
        <input type="radio" :name="nameField" :id="id" :value="modelValue" :checked="isActive">
        {{ label }}
        <span></span>
    </label>
</template>

<script>
    export default {
        name: 'tree-radio',

        props: ['id', 'label', 'nameField', 'modelValue', 'value'],

        computed: {
            isActive () {
                if(this.value.length) {
                    return this.value[0] == this.modelValue ? true : false;
                }

                return false
            }
        }
    }
</script>