
import java.util.Scanner;

public class Main {
    public static boolean found = false;
    public static String[] ans = new String[100];

    public static void turn(int[][] tt, int n, int t, String r) {
        if (n < 0 || n > tt[0].length - 1 || t > tt.length - 1) {
            return;
        }
        if (tt[t][n] == 1) {
            return;
        }
        if (found) {
            return;
        }
        if (tt[t][n] == 0 && t == tt.length - 1) {
            found = true;
        }
        if (tt[t][n] == 0) {
            ans[t] = r;
        }

        turn(tt, n, t + 1, "3");
        turn(tt, n - 1, t + 1, "1");
        turn(tt, n + 1, t + 1, "2");
    }

    public static void main(String[] args) {
        Scanner in = new Scanner(System.in);
        int m = in.nextInt();
        int n = in.nextInt();
        int t = in.nextInt();
        int[][] tt = new int[t][m];
        for (int i = 0; i < t; i++) {
            for (int j = 0; j < m; j++) {
                tt[i][j] = in.nextInt();
            }
        }
        turn(tt, n - 1, 0, "3");
        turn(tt, n - 2, 0, "1");
        turn(tt, n, 0, "2");
        for (int i = 0; i < t; i++) {
            System.out.println(ans[i]);
        }
    }
}
