<template>
<div>
    <header-main />
    <post-container/>
</div>
</template>

<script>

import HeaderMain from '../components/HeaderMain.vue';
import PostContainer from '../components/PostContainer.vue';

export default {
    name: 'App',
    components: {
        HeaderMain,
        PostContainer
    }
}
</script>

<style>

</style>
