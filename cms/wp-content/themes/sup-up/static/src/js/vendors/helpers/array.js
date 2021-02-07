export const each = (array, callback) => {
  const l = array.length;
  for (let i = 0; i < l; i++) {
    const result = callback(array[i], i);
    if (result === false) break;
    if (result === true) continue;
  }
};

export default {
  each,
};
