export const usersMapper = function(users) {
  let result = [];

  result = {
    ...result,
    ...users.reduce(
      (prev, user) => ({
        ...prev,
        [user.id]: userMapper(user)
      }),
      {}
    )
  };

  return result;
};
export const userMapper = user => ({
  id: user.id,
  login: user.login,
  email: user.email,
  createdAt: user.createdAt,
});
