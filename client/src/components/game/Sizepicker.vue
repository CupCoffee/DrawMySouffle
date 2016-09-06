<template lang="html">
    <div class="sizepicker">
        <input class="sizepicker__input" type="range" min="10" max="50" v-model="size">
    </div>
</template>

<script>
export default {
    data() {
        return {
            size: null
        };
    },
    watch: {
        size: function(size)
        {
            this.$dispatch('size-pick', size);
        }
    },
};
</script>
