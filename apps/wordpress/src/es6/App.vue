<template>
  <div id="App">
    <nav>
      <router-link to="/all">All</router-link>
      <router-link to="/country">Country</router-link>
      <router-link to="/fashion">Fashion</router-link>
      <router-link to="/food">Food</router-link>
      <router-link to="/pickup">Pickup</router-link>
      <router-link to="/spot">Spot</router-link>
      <router-link to="/traveller">Traveller</router-link>
    </nav>

    <router-view />
  </div>
</template>