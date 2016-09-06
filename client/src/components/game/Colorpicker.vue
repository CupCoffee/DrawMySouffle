<template lang="html">
    <div class="colorpicker">
        <input class="colorpicker__input" type="color" v-model="color">
    </div>
</template>

<script>
export default {
    data() {
        return {
            color: null
        };
    },
    watch: {
        color: function(color)
        {
            this.$dispatch('color-pick', color);
        }
    },
};
</script>
