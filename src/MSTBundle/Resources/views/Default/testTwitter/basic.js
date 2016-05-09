var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });

    cb(matches);
  };
};

var states = ["Monterey Transit Plaza", "Fisherman’s Wharf", "Lighthouse Ave.", "Monterey Bay Aquarium", "Downtown Pacific Grove",
 "Pacific Grove Golf Course", "Point Piños", "Asilomar", "Sally J. Griffin Senior Center", "Lovers Point", "Downtown Carmel", "Del Monte Center",
 "David Ave.", "Forest Hill", "Country Club Gate Shopping Center", "Del Monte Park",
 "0"
];

/*["0", "ChIJCZNKmxjkjYARoMqK_H2LJkk", "ChIJk8YWsbLmjYARRf8uMI-y58k", "ChIJA6StY6rmjYARA7kKOUgjZ70", "ChIJNZQbXjjhjYARrEQ2zN6flao", "ChIJ_ZgW9BbhjYARsi1pcajC1co", "ChIJa8XMzRXhjYARMfVqRBPd19A", "ChIJjS15EiXkjYARhJqwm5PU5hY" ]*/
$('#the-basics .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'states',
  source: substringMatcher(states)
});
