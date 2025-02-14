<template>
    <el-button type="primary" text @click="this.filtersDialog=true">
        Filters
    </el-button>
    <el-drawer v-model="this.filtersDialog" direction="rtl" class="properties-filters">
        <div class="properties-filters__content m-4">
            <el-form :model="this.filters" label="Filters" label-width="auto"
                    style="max-width: 100%" name="properties_filters_form" id="properties-filters-form">

                <el-form-item label="Name:">
                    <el-input v-model="this.filters.name" style="max-width: 80%" />
                </el-form-item>
                <el-form-item label="Bedrooms:">
                    <el-input-number v-model="this.filters.bedrooms" :min="0" :max="10" class="mx-4" />
                </el-form-item>

                <el-form-item label="Bathrooms:">
                    <el-input-number v-model="this.filters.bathrooms" :min="0" :max="10" class="mx-4" />
                </el-form-item>

                <el-form-item label="Storeys:">
                    <el-input-number v-model="this.filters.storeys" :min="0" :max="10" class="mx-4" />
                </el-form-item>

                <el-form-item label="Garages:">
                    <el-input-number v-model="this.filters.garages" :min="0" :max="10" class="mx-4" />
                </el-form-item>

                <el-form-item label="Price:" class="properties-filters-price">
                    <el-slider v-model="this.filters.priceRange" range :min="this.filtersSettings.priceMin" :max="this.filtersSettings.priceMax" />
                </el-form-item>

            </el-form>
            <div class="properties-filters__footer mt-5 ml-3">
                <el-button type="success" @click="this.onSearch">Search</el-button>
                <el-button type="warning" @click="this.onReset">Reset</el-button>
            </div>
        </div>
    </el-drawer>
</template>
<script>
export default {
    data() {
        return {
            filtersDialog: false,
        }
    },
    props: {
        filters: {
            type: Object,
            default: {
                name: '',
                bedrooms: 0,
                bathrooms: 0,
                storeys: 0,
                garages: 0,
                priceRange: [0, 0],
            },
        },
        filtersSettings: {
            type: Object,
            default: {
                priceMin: 0,
                priceMax: 100,
            },
        },
    },
    methods: {
        onSearch() {
            this.$emit('update-filters', this.filters);
            this.filtersDialog = false
        },
        onReset() {
            this.filters.name = ''
            this.filters.bedrooms = 0
            this.filters.bathrooms = 0
            this.filters.storeys = 0
            this.filters.garages = 0
            this.filters.priceRange = [this.filtersSettings.priceMin, this.filtersSettings.priceMax]
            this.$emit('update-currentPage', 1);
            this.onSearch()
            this.filtersDialog = false
        },
    },
}
</script>
<style>
.properties-filters-price {
    max-width: 25rem;
}
.properties-filters-price .el-slider {
    margin-top: 0;
    margin-left: 0.75rem;
}
</style>
