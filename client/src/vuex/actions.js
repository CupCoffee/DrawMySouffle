export const setRoomId = ({ dispatch }, roomId) => {
	dispatch('SET_ROOM_ID', roomId);
};

export const setSocket = ({ dispatch }, socket) => {
	dispatch('SET_SOCKET', socket);
};