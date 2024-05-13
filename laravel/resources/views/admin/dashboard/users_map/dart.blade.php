<script>
const options = {
  container: document.getElementById("locationChart"),
  padding: {
    top: 0,
    right: 0,
    bottom: 0,
    left: 0,
  },
  topology,
  series: [
    {
      type: "map-shape-background",
      topology,
    },
    {
      type: "map-marker",
      topology,
      data: [
        ...europeData,
        ...asiaData,
        ...africaData,
        ...northAmericaData,
        ...southAmericaData,
        ...oceaniaData,
      ],
      title: "Population",
      idKey: "name",
      idName: "Country",
      sizeKey: "pop_est",
      sizeName: "Population Estimate",
      topologyIdKey: "NAME_ENGL",
      size: 5,
      maxSize: 60,
      labelKey: "name",
      showInLegend: false,
    },
  ],
};

agCharts.AgCharts.create(options);
const labelOptions = {
  labelKey: "iso2",
  labelName: "Country Code",
  label: {
    fontWeight: "lighter",
  },
};

</script>