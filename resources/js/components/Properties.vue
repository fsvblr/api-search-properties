<template>
    <div id="properties-app" class="properties-app"
         v-loading="this.loading"
         element-loading-text="Loading..."
         :element-loading-spinner="svg"
         element-loading-svg-view-box="-10, -10, 50, 50"
         element-loading-background="rgba(122, 122, 122, 0.4)"
    >
        <PropertiesFilters
            :filters="this.filters" @update-filters="updateFilters"
            :filtersSettings="this.filtersSettings"
            :currentPage="this.currentPage" @update-currentPage="updateCurrentPage"
        />

        <div class="property-list mt-6">
            <div v-if="this.properties.length === 0">There is no data to display.</div>
            <el-table v-if="this.properties.length > 0" :data="this.properties" border style="width: 100%"
                    :cell-class-name="classChecker" header-cell-class-name="properties-table-header" >
                <el-table-column prop="name" label="Name" width="200" />
                <el-table-column prop="price" label="Price" width="120" />
                <el-table-column prop="bedrooms" label="Bedrooms" width="100" />
                <el-table-column prop="bathrooms" label="Bathrooms" width="100" />
                <el-table-column prop="storeys" label="Storeys" width="100" />
                <el-table-column prop="garages" label="Garages" width="100" />
                <el-table-column>
                    <template #default="scope">
                        <el-button size="small" @click="handleReadMore(scope.$index, scope.row)">
                            Read more
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>

        <div class="properties-pagination my-3">
            <el-pagination layout="prev, pager, next" :hide-on-single-page="1"
                :page-size="this.itemsPerPage" :total="this.itemsTotal"
                :current-page="this.currentPage" @update:current-page="handleCurrentPageChange" />
        </div>
    </div>
</template>

<script>
import PropertiesFilters from './PropertiesFilters.vue'
import axios from 'axios'

const svg = `
        <path class="path" d="
          M 30 15
          L 28 17
          M 25.61 25.61
          A 15 15, 0, 0, 1, 15 30
          A 15 15, 0, 1, 1, 27.99 7.5
          L 15 15
        " style="stroke-width: 4px; fill: rgba(0, 0, 0, 0)"/>
      `

export default {
    components: {
        PropertiesFilters
    },
    data() {
        return {
            properties: [],
            itemsPerPage: 5,
            itemsTotal: 0,
            currentPage: 1,
            filters: {},
            filtersSettings: {
                priceMin: 0,
                priceMax: 100,
            },
            loading: false,
        }
    },
    methods: {
        classChecker({ row, column, rowIndex, columnIndex }) {
            if (column.property && column.property !== 'name') {
                return 'text-center'
            }
        },
        handleReadMore(index, property) {
            window.location.href = '/properties/' + property.id
        },
        handleCurrentPageChange(val) {
            this.currentPage = val
            this.getProperties()
        },
        updateFilters(filters) {
            this.filters = filters
            this.getProperties()
        },
        updateCurrentPage(page) {
            this.currentPage = page
        },
        getProperties(callback) {
            this.loading = true
            let formData = this.filters
            setTimeout(async () => {
                try {
                    await axios.get('/api/v1/properties?page=' + this.currentPage, {params: formData})
                        .then((response) => {
                            //console.log(response)
                            this.processingResponse(response.data)
                            if (callback) {
                                callback()
                            }
                        })
                        .finally(() => {
                            this.loading = false
                        })
                } catch (error) {
                    //console.log(error)
                }
            }, 50)
        },
        processingResponse(response) {
            if (response.hasOwnProperty('data')) {
                this.properties = response.data
            }
            if (response.hasOwnProperty('meta')) {
                if (response.meta.hasOwnProperty('per_page')) {
                    this.itemsPerPage = parseInt(response.meta.per_page)
                }
                if (response.meta.hasOwnProperty('total')) {
                    this.itemsTotal = parseInt(response.meta.total)
                }
                if (response.meta.hasOwnProperty('current_page')) {
                    this.currentPage = parseInt(response.meta.current_page)
                } else {
                    this.currentPage = 1
                }
            }
        },
        setFiltersSettings() {
            if (this.properties.length) {
                let prices = this.properties.map(obj => obj.price)
                this.filtersSettings.priceMin = Math.min(...prices)
                this.filtersSettings.priceMax = Math.max(...prices)
            }
        },
    },
    mounted() {
        this.getProperties(this.setFiltersSettings)
    },
}
</script>
<style>
.properties-app .properties-table-header {
    text-align: center;
}
.properties-app .properties-table-header:first-of-type {
    text-align: left;
}
.properties-app .text-center {
    text-align: center;
}
</style>
