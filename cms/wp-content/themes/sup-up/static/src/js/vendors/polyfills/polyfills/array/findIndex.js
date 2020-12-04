// https://tc39.github.io/ecma262/#sec-array.prototype.findIndex
if (!Array.prototype.findIndex) {
  Object.defineProperty(Array.prototype, 'findIndex', {
    value: function(predicate) {
     // 1. Let O be ? ToObject(this value).
      if (this == null) {
        throw new TypeError('"this" ma wartość null lub undefined');
      }

      var o = Object(this);

      // 2. Niech len będzie ? ToLength(? Get(O, "length")).
      var len = o.length >>> 0;

      // 3. Jeśli IsCallable(predicate) jest fałszem, rzuć wyjątek TypeError.
      if (typeof predicate !== 'function') {
        throw new TypeError('predykat musi być funkcją');
      }

      // 4. Jeśli thisArg został podany, niech T będzie thisArg; w przeciwnym wypadku, niech T będzie undefined.
      var thisArg = arguments[1];

      // 5. Let k be 0.
      var k = 0;

      // 6. Powtarzaj, dopóki k < len
      while (k < len) {
        // a. Niech Pk będzie ! ToString(k).
        // b. Niech kValue będzie ? Get(O, Pk).
        // c. Niech testResult będzie ToBoolean(? Call(predicate, T, « kValue, k, O »)).
        // d. Jeśli testResult jest prawdą, zwróć k.
        var kValue = o[k];
        if (predicate.call(thisArg, kValue, k, o)) {
          return k;
        }
        // e. Zwiększ wartość k o 1.
        k++;
      }

      // 7. Return -1.
      return -1;
    }
  });
}