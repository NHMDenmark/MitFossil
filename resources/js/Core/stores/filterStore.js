import { defineStore } from "pinia";

export const useFilterStore = defineStore('filter',{
   state: () => ({
       search: null,
       noValidated: false,
       noClassified: false,
       filter: null,
       fossils: []
   }),
    actions: {
       setFilter(value) {
           this.search = value.search;
           this.noValidated = value.noValidated;
           this.noClassified = value.noClassified;
           this.filter = value.filter;
       },
    }
});
